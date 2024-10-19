<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        if ($user && $credentials['password'] === $user->password) {
            Auth::login($user);
            session(['role' => $user->rol->rol]);
            return response()->json([
                'message' => 'Login exitoso',
                'redirect_url' => route('users')
            ]);
        }

        return response()->json([
            'message' => 'Correo o contraseña incorrectos.'
        ], 422);
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('login');
    }
}
