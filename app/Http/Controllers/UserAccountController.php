<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserAccountController extends Controller
{
    public function createForm()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|email|unique:user_accounts,username',
            'password' => 'nullable|min:6',
            'defaultpassword' => 'nullable|min:6',
        ]);
    
        $passwordToUse = $request->password ?? $request->defaultpassword;
    
        if (!$passwordToUse) {
            return back()->withErrors(['password' => 'You must provide a password or a default password.']);
        }
    
        UserAccount::create([
            'username' => $request->username,
            'password' => Hash::make($passwordToUse),
            'defaultpassword' => $request->defaultpassword ? Hash::make($request->defaultpassword) : null,
        ]);
    
        return redirect()->back()->with('success', 'User created successfully!');
    }
    
    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = UserAccount::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Invalid credentials.']);
        }

        Auth::login($user);
        session(['user' => $user]);

        if ($user->defaultpassword) {
            return redirect()->route('user.updatePasswordForm');
        }

        return redirect()->route('dashboard');
    }

    public function updatePasswordForm()
    {
        return view('user.update-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user() ?? session('user');

        $user->password = Hash::make($request->new_password);
        $user->defaultpassword = false;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password updated successfully.');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
