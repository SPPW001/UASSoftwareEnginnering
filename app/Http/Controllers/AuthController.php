<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->with('error', 'Email atau password salah. Ya, bahkan sistem pun punya standar.');
        }

        session(['user_id' => $user->id, 'role' => $user->role]);
        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('home')->with('success', 'Berhasil logout.');
    }
}
