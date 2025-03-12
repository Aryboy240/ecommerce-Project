<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    // Handle the admin login
    public function login(Request $request)
    {
        // Validate the form input
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the user is an admin
        $admin = User::where('name', $credentials['username'])->where('is_admin', true)->first();

        // If the admin exists and the credentials are correct
        if ($admin && Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']])) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // If login fails, return back with an error
        return back()->withErrors([
            'loginError' => 'Invalid admin credentials or you are not an admin.',
        ]);
    }

    // Admin logout
    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Redirect to the admin login page
        return redirect()->route('admin.login');
    }
}