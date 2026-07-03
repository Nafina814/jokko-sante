<?php

namespace App\Http\Controllers;

use App\Models\Rendezvous;
use App\Models\User;
use App\Models\NotificationPlateforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    public function index()
    {
        $psychologues = User::whereHas('role', fn($q) => $q->where('nom', 'psychologue'))
            ->where('actif', true)
            ->get();

        $mesRdv = Rendezvous::with('psychologue')
            ->where('patient_id', Auth::id())
            ->latest()
            ->get();

        return view('rendezvous.index', compact('psychologues', 'mesRdv'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'psychologue_id' => 'required|exists:users,id',
            'date_heure'     => 'required|date|after:now',
            'motif'          => 'nullable|string|max:500',
        ], [
            'psychologue_id.required' => 'Veuillez choisir un psychologue.',
            'date_heure.required'     => 'Veuillez choisir une date et heure.',
            'date_heure.after'        => 'La date doit être dans le futur.',
        ]);

        $rdv = Rendezvous::create([
            'patient_id'     => Auth::id(),
            'psychologue_id' => $request->psychologue_id,
            'date_heure'     => $request->date_heure,
            'motif'          => $request->motif,
            'statut'         => 'en_attente',
        ]);

        // Notification au psychologue
        NotificationPlateforme::create([
            'user_id' => $request->psychologue_id,
            'titre'   => 'Nouvelle demande de rendez-vous',
            'message' => Auth::user()->name . ' a demandé un rendez-vous le ' .
                         \Carbon\Carbon::parse($request->date_heure)->format('d/m/Y à H:i'),
            'type'    => 'rdv',
        ]);

        return redirect()->route('rendezvous.index')
            ->with('success', 'Votre demande de rendez-vous a été envoyée avec succès !');
    }

    public function destroy(Rendezvous $rendezvous)
    {
        if ($rendezvous->patient_id !== Auth::id()) {
            abort(403);
        }

        $rendezvous->update(['statut' => 'annule']);

        return redirect()->route('rendezvous.index')
            ->with('success', 'Rendez-vous annulé.');
    }
}