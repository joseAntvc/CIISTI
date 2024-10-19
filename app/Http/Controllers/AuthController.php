<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = \App\Models\User::where('email', $credentials['email'])->first();

        // Comparación directa de la contraseña sin usar Hash::check
        if ($user && $credentials['password'] === $user->password) {
            Auth::login($user);  // Iniciar sesión si coincide la contraseña
            session(['role' => $user->rol->rol]);
            return redirect()->route('users');
        } else {
            return back()->withErrors(['email' => 'Credenciales incorrectas']);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush(); // Limpiar la sesión
        return redirect()->route('login');
    }
}
