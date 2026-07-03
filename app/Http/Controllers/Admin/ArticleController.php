<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('auteur')->latest()->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre'     => 'required|string|max:255',
            'contenu'   => 'required|string',
            'categorie' => 'required|in:sensibilisation,prevention,temoignage,ressource',
            'statut'    => 'required|in:brouillon,publie',
        ], [
            'titre.required'     => 'Le titre est obligatoire.',
            'contenu.required'   => 'Le contenu est obligatoire.',
            'categorie.required' => 'La catégorie est obligatoire.',
        ]);

        Article::create([
            'titre'     => $request->titre,
            'contenu'   => $request->contenu,
            'categorie' => $request->categorie,
            'statut'    => $request->statut,
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'titre'     => 'required|string|max:255',
            'contenu'   => 'required|string',
            'categorie' => 'required|in:sensibilisation,prevention,temoignage,ressource',
            'statut'    => 'required|in:brouillon,publie',
        ]);

        $article->update([
            'titre'     => $request->titre,
            'contenu'   => $request->contenu,
            'categorie' => $request->categorie,
            'statut'    => $request->statut,
        ]);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}