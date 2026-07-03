<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\InscriptionConfirmation;
use App\Models\NotificationPlateforme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $role = $request->input('role', 'utilisateur');

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'genre' => 'required|in:homme,femme,autre',
            'telephone' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^(\+221|00221|221)?[7][0-9]{8}$/',
            ],
            'role' => 'required|in:utilisateur,psychologue,pair_aidant',
        ];

        $messages = [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'genre.required' => 'Le genre est obligatoire.',
            'telephone.regex' => 'Le numéro doit être un numéro sénégalais valide (ex. : +221771234567).',
        ];

        if ($role === 'psychologue') {
            $rules['numero_ordre'] = 'required|string|max:100';
            $rules['specialite'] = 'required|string|max:255';
            $rules['etablissement'] = 'required|string|max:255';

            $messages['numero_ordre.required'] = 'Le numéro d\'ordre est obligatoire.';
            $messages['specialite.required'] = 'La spécialité est obligatoire.';
            $messages['etablissement.required'] = 'L\'établissement est obligatoire.';
        }

        if ($role === 'pair_aidant') {
            $rules['type_pair_aidant'] = 'required|in:badienou_gokh,ong,benevole';
            $rules['motivation'] = 'required|string|min:50';
            $rules['organisation'] = 'nullable|string|max:255';

            $messages['type_pair_aidant.required'] = 'Le type de pair-aidant est obligatoire.';
            $messages['motivation.required'] = 'La motivation est obligatoire.';
            $messages['motivation.min'] = 'Veuillez décrire votre motivation en au moins 50 caractères.';
        }

        $validated = $request->validate($rules, $messages);

        $roleMap = [
            'utilisateur' => 3,
            'psychologue' => 2,
            'pair_aidant' => 4,
        ];

        $roleId = $roleMap[$role];
        $statutValidation = in_array($role, ['psychologue', 'pair_aidant'], true)
            ? 'en_attente'
            : 'valide';

        $actif = $role === 'utilisateur';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => $roleId,
            'genre' => $validated['genre'],
            'telephone' => $validated['telephone'] ?? null,
            'universite' => $request->input('universite'),
            'numero_ordre' => $role === 'psychologue' ? $validated['numero_ordre'] : null,
            'specialite' => $role === 'psychologue' ? $validated['specialite'] : null,
            'etablissement' => $role === 'psychologue' ? $validated['etablissement'] : null,
            'type_pair_aidant' => $role === 'pair_aidant' ? $validated['type_pair_aidant'] : null,
            'motivation' => $role === 'pair_aidant' ? $validated['motivation'] : null,
            'organisation' => $role === 'pair_aidant' ? ($validated['organisation'] ?? null) : null,
            'statut_validation' => $statutValidation,
            'actif' => $actif,
        ]);

        /*
         * Envoie le message après la création réussie du compte.
         * L'inscription continue même si Gmail rencontre un problème.
         */
        try {
            Mail::to($user->email)->send(
                new InscriptionConfirmation($user)
            );

            Log::info('E-mail de confirmation envoyé.', [
                'user_id' => $user->id,
                'email' => $user->email,
            ]);
        } catch (\Throwable $e) {
            Log::error('Échec de l’envoi de l’e-mail de confirmation.', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
            ]);
        }

        if (in_array($role, ['psychologue', 'pair_aidant'], true)) {
            $admins = User::whereHas(
                'role',
                fn ($query) => $query->where('nom', 'admin')
            )->get();

            $typeLabel = $role === 'psychologue'
                ? 'Psychologue'
                : 'Pair-aidant';

            foreach ($admins as $admin) {
                NotificationPlateforme::create([
                    'user_id' => $admin->id,
                    'titre' => "🔔 Nouvelle demande {$typeLabel} — {$user->name}",
                    'message' => "Un nouveau compte {$typeLabel} attend votre validation. "
                        . "Email : {$user->email}. "
                        . "Téléphone : " . ($user->telephone ?? 'Non renseigné') . ". "
                        . "Allez dans Gestion des utilisateurs pour valider ou rejeter.",
                    'type' => 'alerte',
                ]);
            }

            return redirect()
                ->route('register.attente')
                ->with(
                    'success',
                    'Votre demande a été soumise. Un e-mail de confirmation vous a été envoyé.'
                );
        }

        Auth::login($user);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Bienvenue ' . $user->name . ' ! Un e-mail de confirmation vous a été envoyé.'
            );
    }

    public function attente()
    {
        return view('auth.attente');
    }
}