<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CompteValide;
use App\Mail\CompteRejete;
use App\Models\User;
use App\Models\Role;
use App\Models\NotificationPlateforme;
use App\Models\Temoignage;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\TemoignageCommentaire;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->orderBy('created_at', 'desc')->get();
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $user->update(['role_id' => $request->role_id]);
        return back()->with('success', 'Rôle de ' . $user->name . ' mis à jour avec succès.');
    }

    public function toggleActif(User $user)
    {
        $user->update(['actif' => !$user->actif]);
        $statut = $user->actif ? 'activé' : 'désactivé';
        return back()->with('success', 'Compte de ' . $user->name . ' ' . $statut . '.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
        $user->delete();
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }

    public function valider(User $user)
    {
        $user->update([
            'statut_validation' => 'valide',
            'actif'             => true,
        ]);

        NotificationPlateforme::create([
            'user_id' => $user->id,
            'titre'   => '✅ Compte validé — Bienvenue sur Jokko Santé !',
            'message' => 'Votre compte a été validé par notre équipe. Vous pouvez maintenant vous connecter et accéder à votre espace.',
            'type'    => 'info',
        ]);

        try {
            $user->load('role');
            Mail::to($user->email)->send(new CompteValide($user));
        } catch (\Throwable $e) {
            Log::error('Échec email validation compte', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
        }

        return back()->with('success', "Compte de {$user->name} validé avec succès.");
    }

    public function rejeter(User $user)
    {
        $user->update([
            'statut_validation' => 'rejete',
            'actif'             => false,
        ]);

        NotificationPlateforme::create([
            'user_id' => $user->id,
            'titre'   => '❌ Demande non retenue',
            'message' => 'Votre demande n\'a pas pu être validée. Contactez-nous pour plus d\'informations.',
            'type'    => 'alerte',
        ]);

        try {
            $user->load('role');
            Mail::to($user->email)->send(new CompteRejete($user));
        } catch (\Throwable $e) {
            Log::error('Échec email rejet compte', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);
        }

        return back()->with('success', "Compte de {$user->name} rejeté.");
    }

    // ── MODÉRATION TÉMOIGNAGES ──
    public function temoignages()
    {
        $temoignages = Temoignage::with('auteur')
            ->orderByRaw("FIELD(statut, 'en_attente', 'publie', 'rejete')")
            ->latest()->get();

        return view('admin.moderation.temoignages', compact('temoignages'));
    }

    public function publierTemoignage(Temoignage $temoignage)
{
    $temoignage->update(['statut' => 'publie']);

    // Création de la notification avec un type plus court
    NotificationPlateforme::create([
        'user_id' => $temoignage->user_id,
        'titre'   => '✅ Votre témoignage a été publié',
        'message' => 'Votre témoignage "' . $temoignage->titre . '" est maintenant visible par la communauté.',
        'type'    => 'success',   // Changé de 'info' à 'success'
    ]);

    return back()->with('success', 'Témoignage publié avec succès.');
}

public function rejeterTemoignage(Temoignage $temoignage)
{
    $temoignage->update(['statut' => 'rejete']);

    NotificationPlateforme::create([
        'user_id' => $temoignage->user_id,
        'titre'   => '❌ Témoignage non retenu',
        'message' => 'Votre témoignage "' . $temoignage->titre . '" n\'a pas pu être publié.',
        'type'    => 'error',     // Changé en 'error'
    ]);

    return back()->with('success', 'Témoignage rejeté.');
}

    public function supprimerCommentaire(TemoignageCommentaire $commentaire)
    {
        $commentaire->delete();
    
        return back()->with(
            'success',
            'Commentaire supprimé.'
        );
    }
}