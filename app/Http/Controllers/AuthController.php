<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Afficher le formulaire d'inscription
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Traitement de l'inscription.
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user', // Tous les nouveaux utilisateurs sont "user" par défaut
    ]);

    return redirect('/login')->with('success', 'Inscription réussie. Connectez-vous !');
}


    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traitement de la connexion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard')->with('success', 'Connexion réussie.');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects.']);
    }

    // Déconnexion
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login')->with('success', 'Déconnexion réussie.');
    }
}
