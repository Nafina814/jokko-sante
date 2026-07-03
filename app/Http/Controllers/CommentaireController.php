<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    public function store(Request $request, \App\Models\Article $article)
{
    if (auth()->user()->role->nom !== 'utilisateur') {
        return back()->with('error', 'Seuls les utilisateurs peuvent commenter.');
    }

    $request->validate([
        'contenu' => 'required|string|min:3',
        'anonyme' => 'boolean',
    ], [
        'contenu.required' => 'Le commentaire ne peut pas être vide.',
        'contenu.min'      => 'Le commentaire doit contenir au moins 3 caractères.',
    ]);

    \App\Models\Commentaire::create([
        'user_id'    => auth()->id(),
        'article_id' => $article->id,
        'contenu'    => $request->contenu,
        'anonyme'    => $request->boolean('anonyme'),
    ]);

    return back()->with('success', 'Votre commentaire a été publié.');
}

public function destroy(\App\Models\Commentaire $commentaire)
{
    if (auth()->id() !== $commentaire->user_id && auth()->user()->role->nom !== 'admin') {
        abort(403);
    }
    $commentaire->delete();
    return back()->with('success', 'Commentaire supprimé.');
}
}