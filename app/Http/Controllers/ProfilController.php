<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user  = Auth::user();
        $stats = [];
    
        if ($user->isAdmin()) {
            $stats = [
                'total_users'    => \App\Models\User::count(),
                'total_articles' => \App\Models\Article::count(),
                'total_rdv'      => \App\Models\Rendezvous::count(),
                'total_forums'   => \App\Models\Forum::count(),
            ];
            return view('profil.admin', compact('user', 'stats'));
        }
    
        if ($user->isPsychologue()) {
            $stats = [
                'rdv_en_attente' => \App\Models\Rendezvous::where('psychologue_id', $user->id)->where('statut', 'en_attente')->count(),
                'rdv_confirmes'  => \App\Models\Rendezvous::where('psychologue_id', $user->id)->where('statut', 'confirme')->count(),
                'rdv_termines'   => \App\Models\Rendezvous::where('psychologue_id', $user->id)->where('statut', 'termine')->count(),
            ];
            return view('profil.psychologue', compact('user', 'stats'));
        }
    
        if ($user->isPairAidant()) {
            $stats = [
                'forums'   => $user->forums()->count(),
                'reponses' => \App\Models\ForumReponse::where('user_id', $user->id)->count(),
                'messages' => \App\Models\Message::where('expediteur_id', $user->id)->count(),
            ];
            return view('profil.pair_aidant', compact('user', 'stats'));
        }
    
        // Utilisateur standard
        $stats = [
            'tests'      => $user->testsPhq9()->count(),
            'rendezvous' => $user->rendezvousPatient()->count(),
            'forums'     => $user->forums()->count(),
        ];
        return view('profil.utilisateur', compact('user', 'stats'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'telephone'  => 'nullable|string|max:20',
            'universite' => 'nullable|string|max:255',
            'genre'      => 'required|in:homme,femme,autre',
        ], [
            'name.required'  => 'Le nom est obligatoire.',
            'genre.required' => 'Le genre est obligatoire.',
        ]);

        $user->update([
            'name'       => $request->name,
            'telephone'  => $request->telephone,
            'universite' => $request->universite,
            'genre'      => $request->genre,
        ]);

        return back()->with('success', 'Profil mis à jour avec succès.');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ], [
            'current_password.required' => 'Le mot de passe actuel est obligatoire.',
            'password.required'         => 'Le nouveau mot de passe est obligatoire.',
            'password.min'              => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'        => 'Les mots de passe ne correspondent pas.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Mot de passe modifié avec succès.');
    }
}