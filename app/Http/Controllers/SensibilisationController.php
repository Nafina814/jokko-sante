<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class SensibilisationController extends Controller
{
    public function index()
    {
        $articles = Article::with(['categorie', 'auteur'])
            ->latest()
            ->get();

        $temoignages = Temoignage::with('auteur')
            ->where('statut', 'publie')
            ->latest()
            ->get();

        return view('sensibilisation.index', compact('articles', 'temoignages'));
    }

    public function show(Article $article)
    {
        if ($article->statut !== 'publie') {
            abort(404);
        }

        $article->load(['commentaires.auteur', 'auteur', 'categorie']);

        return view('sensibilisation.show', compact('article'));
    }
}