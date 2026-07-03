<?php

namespace App\Http\Controllers\PairAidant;

use App\Http\Controllers\Controller;
use App\Models\Signalement;
use App\Models\NotificationPlateforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignalementController extends Controller
{
    public function index()
    {
        // Le pair-aidant voit TOUS les signalements publics
        // mais ne peut PAS changer le statut
        $signalements = Signalement::with('user')
            ->latest()
            ->get();

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
                    'name'  => $sig->user->anonyme ? 'Anonyme' : $sig->user->name,
                    'email' => $sig->user->anonyme ? '—' : $sig->user->email,
                ],
            ];
        });

        $stats = [
            'total'          => $signalements->count(),
            'en_attente'     => $signalements->where('statut', 'en_attente')->count(),
            'pris_en_charge' => $signalements->where('statut', 'pris_en_charge')->count(),
            'traite'         => $signalements->where('statut', 'traite')->count(),
        ];

        return view('pair_aidant.signalements', compact('signalements', 'signalementsJson', 'stats'));
    }
}