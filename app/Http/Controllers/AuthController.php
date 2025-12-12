<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function ShowLogin() {
        return view('auth.login');
    }

    public function ShowRegister() {
        return view('auth.register');
    }

    public function Register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'User created successfully');
    }

    public function Login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard')->with('success', 'Login successful');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function Logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful');
    }
}
