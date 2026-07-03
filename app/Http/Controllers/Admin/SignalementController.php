<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Signalement;
use App\Models\NotificationPlateforme;
use Illuminate\Http\Request;

class SignalementController extends Controller
{
    public function index()
    {
        $signalements = Signalement::with('user')->latest()->get();
    
        // Préparer les données pour la carte
        $signalementsJson = $signalements->map(function($sig) {
            return [
                'id'          => $sig->id,
                'description' => $sig->description,
                'categorie'   => $sig->categorie,
                'urgence'     => $sig->urgence,
                'statut'      => $sig->statut,
                'latitude'    => $sig->latitude,
                'longitude'   => $sig->longitude,
                'photo'       => $sig->photo ? asset('storage/'.$sig->photo) : null,
                'created_at'  => $sig->created_at->format('d/m/Y à H:i'),
                'user'        => [
                    'name'  => $sig->user->name,
                    'email' => $sig->user->email,
                ],
            ];
        });
    
        $stats = [
            'total'          => $signalements->count(),
            'en_attente'     => $signalements->where('statut', 'en_attente')->count(),
            'pris_en_charge' => $signalements->where('statut', 'pris_en_charge')->count(),
            'traite'         => $signalements->where('statut', 'traite')->count(),
        ];
    
        return view('admin.signalements.index', compact('signalements', 'signalementsJson', 'stats'));
    }
    public function updateStatut(Request $request, Signalement $signalement)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,pris_en_charge,traite',
        ]);

        $ancienStatut = $signalement->statut;
        $signalement->update(['statut' => $request->statut]);

        // Notification au citoyen
        $messages = [
            'pris_en_charge' => 'Votre signalement a été pris en charge par notre équipe.',
            'traite'         => 'Votre signalement a été traité et résolu. Merci de votre confiance.',
        ];

        if (isset($messages[$request->statut])) {
            NotificationPlateforme::create([
                'user_id' => $signalement->user_id,
                'titre'   => 'Mise à jour de votre signalement',
                'message' => $messages[$request->statut],
                'type'    => 'alerte',
            ]);
        }

        return back()->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy(Signalement $signalement)
    {
        $signalement->delete();
        return back()->with('success', 'Signalement supprimé.');
    }
}