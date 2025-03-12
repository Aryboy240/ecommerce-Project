<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function index()
    {
        return view('Account');
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'new_username' => ['required', 'string', 'max:255', 'unique:users,name'],
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        $user->name = $request->new_username;
        $user->save();

        return back()->with('success', 'Username updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'new_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'current_password'],
        ]);

        $user = Auth::user();
        $user->email = $request->new_email;
        $user->save();

        return back()->with('success', 'Email updated successfully!');
    }

    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->save();

        return back()->with('success', 'Personal information updated successfully!');
    }

    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'max:2048'], // max 2MB
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile-pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function updateBillingAddress(Request $request)
    {
        $request->validate([
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postcode' => ['required', 'string', 'max:20'],
            'county' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        
        // Assuming you have a billing_address relationship or columns
        // Modify this according to your database structure
        $user->billing_address = [
            'street' => $request->street,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'county' => $request->county,
            'country' => $request->country,
        ];
        $user->save();

        return back()->with('success', 'Billing address updated successfully!');
    }
} 