<?php

namespace App\Http\Controllers\Psychologue;

use App\Http\Controllers\Controller;
use App\Models\Rendezvous;
use App\Models\NotificationPlateforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezvousController extends Controller
{
    public function index()
    {
        $rdvEnAttente = Rendezvous::with('patient')
            ->where('psychologue_id', Auth::id())
            ->where('statut', 'en_attente')
            ->latest()
            ->get();

        $rdvConfirmes = Rendezvous::with('patient')
            ->where('psychologue_id', Auth::id())
            ->where('statut', 'confirme')
            ->latest()
            ->get();

        $rdvTermines = Rendezvous::with('patient')
            ->where('psychologue_id', Auth::id())
            ->whereIn('statut', ['termine', 'annule'])
            ->latest()
            ->take(10)
            ->get();

        return view('psychologue.rendezvous', compact(
            'rdvEnAttente', 'rdvConfirmes', 'rdvTermines'
        ));
    }

    public function confirmer(Rendezvous $rendezvous)
    {
        if ($rendezvous->psychologue_id !== Auth::id()) abort(403);

        $rendezvous->update(['statut' => 'confirme']);

        NotificationPlateforme::create([
            'user_id' => $rendezvous->patient_id,
            'titre'   => 'Rendez-vous confirmé !',
            'message' => 'Votre rendez-vous du ' .
                         $rendezvous->date_heure->format('d/m/Y à H:i') .
                         ' a été confirmé par votre psychologue.',
            'type'    => 'rdv',
        ]);

        return back()->with('success', 'Rendez-vous confirmé avec succès.');
    }

    public function terminer(Rendezvous $rendezvous)
    {
        if ($rendezvous->psychologue_id !== Auth::id()) abort(403);

        $rendezvous->update(['statut' => 'termine']);

        return back()->with('success', 'Rendez-vous marqué comme terminé.');
    }

    public function annuler(Rendezvous $rendezvous)
    {
        if ($rendezvous->psychologue_id !== Auth::id()) abort(403);

        $rendezvous->update(['statut' => 'annule']);

        NotificationPlateforme::create([
            'user_id' => $rendezvous->patient_id,
            'titre'   => 'Rendez-vous annulé',
            'message' => 'Votre rendez-vous du ' .
                         $rendezvous->date_heure->format('d/m/Y à H:i') .
                         ' a été annulé. Veuillez en prendre un nouveau.',
            'type'    => 'rdv',
        ]);

        return back()->with('success', 'Rendez-vous annulé.');
    }
}