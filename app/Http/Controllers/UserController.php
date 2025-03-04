<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

    //This allows the user to update their username in the account page - Hussen
    public function updateUsername(Request $request){
        $request->validate([
        auth()->user()->update([
            'username' => $request->input('new_username')
            'new_username' => 'required|string|max:255|unique:users,name,'.auth()->id(),
            'password' => 'required|current_password',
        ]);

        auth()->user()->update([
            'name' => $request->input('new_username')
        ]);
        return back()->with('success','Successfully updated your Username!!');

    }

    //This allows the user to update their email in the account page - Hussen
    public function updateEmail(Request $request){
        $request->validate([
            'new_email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'password' => 'required|current_password',
        ]);

        auth()->user()->update([
            'email' => $request->new_email
        ]);
        return back()->with('success','Successfully updated your Email!');

    }

    //This allows the user to update their password in the account page - Hussen
    public function updatePassword(Request $request){
        $request->validate([
           'current_password' => 'required|current_password',
           'new_password' => 'required|string|min:8|confirmed'        
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->new_password)
        ]);
        
        return back()->with('success','Successfully updated your Password!');

    }

    public function checkLogin()
    {
        return response()->json([
            'logged_in' => auth()->check(), // Check if the user is authenticated
        ]);
    }


}