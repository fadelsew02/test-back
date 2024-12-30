<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Méthode pour afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Méthode d'inscription
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
    }

    // Méthode pour afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Méthode de connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

       

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Connexion réussie.');
        }

        return back()->with('error','Identifiants incorrects.');
    }

    // Méthode de déconnexion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}
