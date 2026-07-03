<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumReponse;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssistanceController extends Controller
{
    // Page principale assistance
    public function index()
    {
        $forums = Forum::with(['auteur', 'reponses'])
            ->where('statut', 'ouvert')
            ->latest()
            ->get();

        // Uniquement psychologues actifs comme destinataires possibles
        $psychologues = User::whereHas('role', fn($q) =>
            $q->where('nom', 'psychologue')
        )->where('actif', true)->get();

        // Pair-aidants actifs
        $pairAidants = User::whereHas('role', fn($q) =>
            $q->where('nom', 'pair_aidant')
        )->where('actif', true)->get();

        return view('assistance.index', compact('forums', 'psychologues', 'pairAidants'));
    }

    // Créer un sujet forum
    public function storeForum(Request $request)
    {
        $request->validate([
            'titre'   => 'required|string|max:255',
            'contenu' => 'required|string|min:10',
            'anonyme' => 'boolean',
        ], [
            'titre.required'   => 'Le titre est obligatoire.',
            'contenu.required' => 'Le contenu est obligatoire.',
            'contenu.min'      => 'Le contenu doit contenir au moins 10 caractères.',
        ]);

        Forum::create([
            'titre'   => $request->titre,
            'contenu' => $request->contenu,
            'user_id' => Auth::id(),
            'anonyme' => $request->boolean('anonyme'),
            'statut'  => 'ouvert',
        ]);

        return redirect()->route('assistance.index')
            ->with('success', 'Votre discussion a été publiée avec succès.');
    }

    // Voir un sujet forum + ses réponses
    public function showForum(Forum $forum)
    {
        $forum->load(['auteur', 'reponses.auteur']);
        return view('assistance.forum', compact('forum'));
    }

    // Répondre à un sujet forum
    public function storeReponse(Request $request, Forum $forum)
    {
        $request->validate([
            'contenu' => 'required|string|min:5',
        ], [
            'contenu.required' => 'La réponse ne peut pas être vide.',
            'contenu.min'      => 'La réponse doit contenir au moins 5 caractères.',
        ]);

        ForumReponse::create([
            'forum_id' => $forum->id,
            'user_id'  => Auth::id(),
            'contenu'  => $request->contenu,
            'anonyme'  => $request->boolean('anonyme'),
        ]);

        return back()->with('success', 'Votre réponse a été publiée.');
    }

    // Envoyer un message privé
   
public function sendMessage(Request $request)
{
    $request->validate([
        'destinataire_id' => 'required|exists:users,id',
        'contenu'         => 'required|string|min:5',
    ], [
        'destinataire_id.required' => 'Veuillez choisir un destinataire.',
        'contenu.required'         => 'Le message ne peut pas être vide.',
        'contenu.min'              => 'Le message doit contenir au moins 5 caractères.',
    ]);

    $expediteur   = Auth::user();
    $roleExpediteur = $expediteur->role->nom ?? null;
    $destinataire = \App\Models\User::findOrFail($request->destinataire_id);
    $roleDestinataire = $destinataire->role->nom ?? null;

    // ── RÈGLES D'ENVOI SELON LE RÔLE ──
    // Utilisateur → peut envoyer à psychologue, pair_aidant, admin
    // Psychologue → peut répondre à utilisateur, pair_aidant, admin
    // Pair-aidant → peut répondre à utilisateur, psychologue, admin
    // Admin       → peut envoyer à tout le monde

    $autorisations = [
        'utilisateur' => ['psychologue', 'pair_aidant', 'admin'],
        'psychologue' => ['utilisateur', 'pair_aidant', 'admin'],
        'pair_aidant' => ['utilisateur', 'psychologue', 'admin'],
        'admin'       => ['utilisateur', 'psychologue', 'pair_aidant', 'admin'],
    ];

    $rolesAutorises = $autorisations[$roleExpediteur] ?? [];

    if (!in_array($roleDestinataire, $rolesAutorises)) {
        return back()->with('error', 'Vous ne pouvez pas envoyer de message à cet utilisateur.');
    }

    \App\Models\Message::create([
        'expediteur_id'   => $expediteur->id,
        'destinataire_id' => $request->destinataire_id,
        'contenu'         => $request->contenu,
        'anonyme'         => $request->boolean('anonyme'),
        'lu'              => false,
    ]);

    return back()->with('success', 'Votre message a été envoyé avec succès.');
}

    // Mes messages — chaque utilisateur voit UNIQUEMENT ses propres messages
    public function mesMessages()
    {
        $userId = Auth::id();

        // Messages reçus par l'utilisateur connecté uniquement
        $messagesRecus = Message::with('expediteur')
            ->where('destinataire_id', $userId)
            ->latest()
            ->get();

        // Messages envoyés par l'utilisateur connecté uniquement
        $messagesEnvoyes = Message::with('destinataire')
            ->where('expediteur_id', $userId)
            ->latest()
            ->get();
        // Marquer les messages reçus comme lus
    \App\Models\Message::where('destinataire_id', $userId)
    ->where('lu', false)
    ->update(['lu' => true]);

$messagesRecus = Message::with('expediteur')
    ->where('destinataire_id', $userId)
    ->latest()
    ->get();

$messagesEnvoyes = Message::with('destinataire')
    ->where('expediteur_id', $userId)
    ->latest()
    ->get();    

        return view('assistance.messages', compact('messagesRecus', 'messagesEnvoyes'));
    }
}