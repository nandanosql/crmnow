<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials are incorrect.',
            ]);
        }

        if (!$user->isActive()) {
            throw ValidationException::withMessages([
                'email' => 'Your account has been disabled. Please contact system administrator.',
            ]);
        }

        if ($user->role !== 'user') {
            throw ValidationException::withMessages([
                'email' => 'Access denied. This area is for regular users only.',
            ]);
        }

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}