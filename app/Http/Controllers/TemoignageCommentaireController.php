<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use App\Models\TemoignageCommentaire;
use Illuminate\Http\Request;

class TemoignageCommentaireController extends Controller
{
    /**
     * Publier un commentaire
     */
    public function store(Request $request, Temoignage $temoignage)
    {
        if (auth()->user()->role->nom !== 'utilisateur') {
            return back()->with(
                'error',
                'Seuls les utilisateurs peuvent commenter.'
            );
        }

        $request->validate([
            'contenu' => 'required|string|min:3|max:1000',
            'anonyme' => 'nullable|boolean',
        ], [
            'contenu.required' => 'Veuillez écrire un commentaire.',
            'contenu.min'      => 'Le commentaire doit contenir au moins 3 caractères.',
            'contenu.max'      => 'Le commentaire est trop long.',
        ]);

        TemoignageCommentaire::create([
            'user_id'        => auth()->id(),
            'temoignage_id'  => $temoignage->id,
            'contenu'        => $request->contenu,
            'anonyme'        => $request->boolean('anonyme'),
        ]);

        return back()->with(
            'success',
            'Votre commentaire a été publié.'
        );
    }

    /**
     * Supprimer un commentaire
     */
    public function destroy(TemoignageCommentaire $commentaire)
    {
        $user = auth()->user();

        if (
            $user->id !== $commentaire->user_id &&
            $user->role->nom !== 'admin'
        ) {
            abort(403);
        }

        $commentaire->delete();

        return back()->with(
            'success',
            'Commentaire supprimé.'
        );
    }
}