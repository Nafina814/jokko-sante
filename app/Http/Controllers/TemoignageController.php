<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemoignageController extends Controller
{
    // Liste des témoignages publiés
    public function index()
    {
        $temoignages = Temoignage::with([
            'auteur',
            'commentaires.auteur'
        ])
        ->where('statut', 'publie')
        ->latest()
        ->paginate(9);
    
        return view(
            'temoignages.index',
            compact('temoignages')
        );
    }

    // Formulaire création
    public function create()
    {
        // Vérification rôle directement dans le contrôleur
        if (auth()->user()->role->nom !== 'utilisateur') {
            return redirect('/dashboard')
                ->with('error', 'Accès réservé aux utilisateurs.');
        }
        return view('temoignages.create');
    }
    
    public function store(Request $request)
    {
        if (auth()->user()->role->nom !== 'utilisateur') {
            return redirect('/dashboard')
                ->with('error', 'Accès réservé aux utilisateurs.');
        }
    
        $request->validate([
            'titre'   => 'required|string|max:255',
            'contenu' => 'required|string|min:20',
            'anonyme' => 'boolean',
        ], [
            'titre.required'   => 'Le titre est obligatoire.',
            'contenu.required' => 'Le contenu est obligatoire.',
            'contenu.min'      => 'Le témoignage doit contenir au moins 20 caractères.',
        ]);
    
        \App\Models\Temoignage::create([
            'user_id' => auth()->id(),
            'titre'   => $request->titre,
            'contenu' => $request->contenu,
            'anonyme' => $request->boolean('anonyme'),
            'statut'  => 'en_attente',
        ]);
    
        return redirect()->route('temoignages.index')
            ->with('success', 'Votre témoignage a été soumis et sera publié après validation.');
    }

    /**
 * Afficher un témoignage
 */
public function show(Temoignage $temoignage)
{
    // Charge les relations nécessaires
    $temoignage->load(['auteur', 'commentaires.auteur']);

    // Optionnel : seulement les témoignages publiés
    if ($temoignage->statut !== 'publie' && !auth()->user()?->isAdmin()) {
        abort(403, 'Ce témoignage n\'est pas encore publié.');
    }

    return view('temoignages.show', compact('temoignage'));
}
}