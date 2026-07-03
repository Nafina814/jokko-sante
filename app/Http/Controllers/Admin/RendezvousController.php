<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rendezvous;
use App\Models\User;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index()
    {
        $rdvEnAttente  = Rendezvous::with(['patient', 'psychologue'])
            ->where('statut', 'en_attente')
            ->latest()->get();

        $rdvConfirmes  = Rendezvous::with(['patient', 'psychologue'])
            ->where('statut', 'confirme')
            ->latest()->get();

        $rdvTermines   = Rendezvous::with(['patient', 'psychologue'])
            ->whereIn('statut', ['termine', 'annule'])
            ->latest()->take(20)->get();

        $totalRdv      = Rendezvous::count();
        $totalAttente  = Rendezvous::where('statut', 'en_attente')->count();
        $totalConfirme = Rendezvous::where('statut', 'confirme')->count();
        $totalTermine  = Rendezvous::where('statut', 'termine')->count();

        return view('admin.rendezvous.index', compact(
            'rdvEnAttente', 'rdvConfirmes', 'rdvTermines',
            'totalRdv', 'totalAttente', 'totalConfirme', 'totalTermine'
        ));
    }

    public function destroy(Rendezvous $rendezvous)
    {
        $rendezvous->delete();
        return back()->with('success', 'Rendez-vous supprimé avec succès.');
    }
}