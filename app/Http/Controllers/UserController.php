<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming fields with more specific rules - Nikhil
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:15', 'alpha_num'],     // 3-15 characters, alphanumeric
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],    // Valid email, unique in users table
            'password' => ['required', 'string', 'min:8', 'max:25'],              // Min 8 characters, confirmed (with Password_confirmation)
            'confirmPassword' => ['required', 'same:password'],                   // Matches Password
            'birthday' => ['required', 'date', 'before:2006-01-01'],              // Valid date, must be before today
        ], [
            // Custom validation messages - Nikhil
            'name.required' => 'The username is required.',
            'name.alpha_num' => 'The username must only contain letters and numbers.',
            'name.min' => 'The username must be at least 3 characters.',
            'name.max' => 'The username must not exceed 15 characters.',
            'name.unique' => 'This username is already taken.',
            'email.max' => 'The email must not exceed 255 characters.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email address must be valid.',
            'email.unique' => 'This email address is already in use.',
            'password.required' => 'A password is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'confirmPassword.same' => 'The confirmation password must match the password.',
            'birthday.required' => 'The birthdate is required.',
            'birthday.date' => 'The birthdate must be a valid date.',
            'birthday.before' => 'You must be 18 or older to make an account!',
        ]);

        // Extra check for username uniqueness - Aryan
        if (User::where('name', $incomingFields['name'])->exists()) {
            return back()->withErrors(['name' => 'This username is already taken.'])->onlyInput('name');
        }

        // You need to encrypt the password too - Aryan
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user); // Then you need to log the user in

        // Redirect back to the homepage after sucsessful register - Nikhil
        return redirect()->route('welcome')->with('success', 'You are now registered!');
    }
    
    // The login system wasn't implemented so I'll make a basic one for now. You can add to this one if you wish - Aryan
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginUsername' => ['required'],
            'loginPassword' => ['required']
        ], [
            // Need to input a username & password into the fields
            'loginUsername.required' => 'The username is required.',
            'loginPassword.required' => 'The password is required.',
        ]);
    
        // Attempt to authenticate the user
        if (auth()->attempt(['name' => $incomingFields['loginUsername'], 'password' => $incomingFields['loginPassword']])) {
            $request->session()->regenerate(); // Prevent session fixation attacks
            return redirect('welcome')->with('success', 'You are now logged in!');
        }
    
        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'loginError' => 'The provided credentials do not match our records.',
        ])->onlyInput('loginUsername'); // Retain the username input for convenience
    }
    
    // There isn't a button to log out yet, I'm waiting for Aqsa to make the user accounts page first
    // Heres a basic logout function that can be applied straigh to the button in the accounts page - Aryan
    public function logout(){
        auth()->logout();
        return redirect('welcome');
    }

    // This function displays the account page - Hussen
    public function account(){
        $user = auth()->user();
        return view('Account',['user' => $user]);
    }

    // This allows the user to update their username in the account page - Aryan
    public function updateUsername(Request $request)
    {
        $request->validate([
            'new_username' => 'required|string|max:255|unique:users,name,' . auth()->id(),
            'password' => 'required|current_password',
        ]);

        auth()->user()->update([
            'name' => $request->input('new_username')
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully updated your Username!']);
    }

    //This allows the user to update their password in the account page - Aryan
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed'
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['success' => true, 'message' => 'Successfully updated your Password!']);
    }

    public function updatePersonalInfo(Request $request)
    {
        // Validate input data
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'birthday' => 'required|date',
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Update user details
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->save();
    
        // Return success response
        return response()->json(['success' => 'Personal information updated successfully!']);
    }
    
    public function checkLogin()
    {
        return response()->json([
            'logged_in' => auth()->check(), // Check if the user is authenticated
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Admin User Update thingy
    |--------------------------------------------------------------------------
    */
    public function showCustomers()
    {
        // Fetch all users
        $users = User::all();
        
        // Return the view with the users data
        return view('admin.AdminCustomers', compact('users'));
    }

    public function getUserInfo($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'fullName' => $user->fullName ?? '', // Use an empty string if null
            'birthday' => $user->birthday->format('Y-m-d'),
        ]);
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'fullName' => 'nullable|string|max:255', // Adding validation for fullName
            'birthday' => 'required|date',
        ]);

        // Update the user details, including fullName
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'fullName' => $request->fullName, // Update fullName
            'birthday' => $request->birthday,
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteUser(Request $request, $id)
    {
        
        $user = User::findOrFail($id);
        $user->delete();
    
        return redirect('/customers');
    }
    

}