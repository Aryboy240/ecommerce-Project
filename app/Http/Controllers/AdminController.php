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
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the user is an admin
        $admin = User::where('name', $credentials['username'])->where('is_admin', true)->first();

        if ($admin && Auth::attempt(['name' => $credentials['username'], 'password' => $credentials['password']])) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'loginError' => 'Invalid admin credentials.',
        ]);
    }

    // Admin logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}