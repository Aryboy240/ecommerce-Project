<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        // Validate the input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log in with the given username and password
        if (auth()->attempt(['name' => $request->username, 'password' => $request->password])) {
            // Check if the logged-in user is an admin
            $user = auth()->user();
            
            // If user is an admin (is_admin = 1), redirect to the admin panel
            if ($user->is_admin == 1) {
                $request->session()->regenerate(); // Prevent session fixation attacks
                return redirect()->route('adminpanel')->with('success', 'Welcome Admin. Login successful!');
            } else {
                // If the user is not an admin (is_admin = 0), log them out and show an error
                auth()->logout();
                return redirect()->route('adminlogin')->withErrors(['loginError' => 'Login Denied. You are not an admin.'])->withInput();
            }
        } else {
            // If login fails, return an error message
            return redirect()->route('adminlogin')->withErrors(['loginError' => 'Login Denied. Invalid credentials.'])->withInput();
        }
    }
    
    public function storeUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:15', 'alpha_num'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'confirmPassword' => ['required', 'same:password'],
            'birthday' => ['required', 'date', 'before:2006-01-01'],
            'fullName' => ['required', 'string', 'max:255'],
            'role' => ['required', 'boolean']
        ], [
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
            'fullName.required' => 'Full name is required.',
            'fullName.string' => 'Full name must be a valid string.',
            'fullName.max' => 'Full name cannot exceed 255 characters.',
        ]);
    
        try {
            $validatedData['password'] = bcrypt($validatedData['password']);
            $validatedData['is_admin'] = $request->role;
    
            User::create($validatedData);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }
    

}