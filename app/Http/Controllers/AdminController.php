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
}