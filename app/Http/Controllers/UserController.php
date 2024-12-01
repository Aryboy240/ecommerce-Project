<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validate incoming fields with more specific rules
        $incomingFields = $request->validate([
            'Username' => ['required', 'string', 'min:3', 'max:15', 'alpha_num'], // 3-15 characters, alphanumeric
            'Email' => ['required', 'email', 'max:255', 'unique:users,email'],    // Valid email, unique in users table
            'Password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'], // Min 8 characters, confirmed (with Password_confirmation)
            'ConfirmPassword' => ['required', 'same:Password'],                   // Matches Password
            'Birthday' => ['required', 'date', 'before:2014-01-01'],              // Valid date, must be before today
        ], [
            // Custom validation messages
            'Username.required' => 'The username is required.',
            'Username.alpha_num' => 'The username must only contain letters and numbers.',
            'Username.min' => 'The username must be at least 3 characters.',
            'Username.max' => 'The username must not exceed 15 characters.',
            'Email.required' => 'The email is required.',
            'Email.email' => 'The email address must be valid.',
            'Email.unique' => 'This email address is already in use.',
            'Password.required' => 'A password is required.',
            'Password.min' => 'The password must be at least 8 characters.',
            'Password.confirmed' => 'The password confirmation does not match.',
            'ConfirmPassword.same' => 'The confirmation password must match the password.',
            'Birthday.required' => 'The birthdate is required.',
            'Birthday.date' => 'The birthdate must be a valid date.',
            'Birthday.before' => 'The birthdate must be before January 1, 2014.',
        ]);
        return redirect()->route('welcome')->with('success', 'You are now registered!');
    }
}