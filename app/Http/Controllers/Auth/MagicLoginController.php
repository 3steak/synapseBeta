<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MagicLoginMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MagicLoginController extends Controller
{
    /**
     * Affiche le formulaire de login par email (magic link).
     */
    public function showForm()
    {
        return view('auth.magic-login');
    }

    /**
     * Envoie un lien de connexion magique à l'email saisi.
     */
    public function sendToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // 🚫 Empêche les admins d'utiliser le Magic Login
        if ($user && $user->hasRole('admin')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Les administrateurs doivent se connecter avec le formulaire classique.',
            ]);
        }

        // Génère un token unique avec expiration
        $token = $user->generateLoginToken();

        // Envoie l'email avec le lien
        Mail::to($user->email)->send(new MagicLoginMail($token));

        return back()->with('status', 'Un lien de connexion vous a été envoyé par email.');
    }

    /**
     * Vérifie le token reçu et connecte l'utilisateur si valide.
     */
    public function verifyToken($token)
    {
        $user = User::where('login_token', $token)
            ->where('login_token_expiry', '>', now())
            ->first();

        if (! $user) {
            return redirect()->route('login')->withErrors(['email' => 'Lien invalide ou expiré.']);
        }

        // Connexion + suppression du token
        Auth::login($user);
        $user->login_token = null;
        $user->login_token_expiry = null;
        $user->save();

        return redirect()->route('dashboard');
    }
}
