<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Rendezvous;
use App\Models\Forum;
use App\Models\Signalement;
use App\Models\Message;
use App\Models\NotificationPlateforme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        Log::info('Dashboard accessed', [
            'auth_check'   => Auth::check(),
            'user_id'      => $user?->id,
            'user_role_id' => $user?->role_id,
            'role_loaded'  => $user?->role?->nom,
            'session_id'   => session()->getId(),
            'session_driver' => config('session.driver'),
        ]);

        if (!$user || !$user->role) {
            Log::warning('Dashboard redirect to login', [
                'user' => $user?->toArray(),
            ]);
            return redirect('/login');
        }

        $role = $user->role->nom;

        // ── ADMIN ──
        if ($role === 'admin') {
            $stats = [
                'totalUsers'            => User::count(),
                'totalPairAidants'      => User::whereHas('role', fn($q) => $q->where('nom', 'pair_aidant'))->count(),
                'totalSignalements'     => Signalement::count(),
                'signalementsEnAttente' => Signalement::where('statut', 'en_attente')->count(),
                'totalRdv'              => Rendezvous::count(),
                'rdvEnCours'            => Rendezvous::where('statut', 'confirme')->count(),
                'totalArticles'         => Article::count(),
                'totalForums'           => Forum::count(),
            ];

            $signalements  = Signalement::with('user')->latest()->take(5)->get();
            $recentUsers   = User::with('role')->latest()->take(5)->get();

            $notifications = NotificationPlateforme::where('user_id', $user->id)
                ->latest()->take(5)->get();

            $messagesRecus = Message::with(['expediteur', 'expediteur.role'])
                ->where('destinataire_id', $user->id)
                ->latest()->take(5)->get();

            $messagesNonLus = Message::where('destinataire_id', $user->id)
                ->where('lu', false)->count();

            return view('dashboard.admin', array_merge(
                $stats,
                compact(
                    'signalements',
                    'recentUsers',
                    'notifications',
                    'messagesRecus',
                    'messagesNonLus'
                )
            ));
        }

        // ── PSYCHOLOGUE ──
        if ($role === 'psychologue') {
            $rdvEnAttente = Rendezvous::where('psychologue_id', $user->id)
                ->where('statut', 'en_attente')->count();

            $rdvConfirmes = Rendezvous::where('psychologue_id', $user->id)
                ->where('statut', 'confirme')
                ->with('patient')->latest()->take(5)->get();

            $notifications = NotificationPlateforme::where('user_id', $user->id)
                ->latest()->take(10)->get();

            $messagesNonLus = Message::where('destinataire_id', $user->id)
                ->where('lu', false)->count();

            return view('dashboard.psychologue', compact(
                'rdvEnAttente',
                'rdvConfirmes',
                'notifications',
                'messagesNonLus'
            ));
        }

        // ── PAIR-AIDANT ──
        if ($role === 'pair_aidant') {
            $forums = Forum::with('reponses')->latest()->take(5)->get();

            $notifications = NotificationPlateforme::where('user_id', $user->id)
                ->latest()->take(10)->get();

            $messagesNonLus = Message::where('destinataire_id', $user->id)
                ->where('lu', false)->count();

            return view('dashboard.pair_aidant', compact(
                'forums',
                'notifications',
                'messagesNonLus'
            ));
        }

        // ── UTILISATEUR ──
        $mesRdv = Rendezvous::where('patient_id', $user->id)
            ->with('psychologue')->latest()->take(3)->get();

        $notifications = NotificationPlateforme::where('user_id', $user->id)
            ->latest()->take(5)->get();

        $messagesNonLus = Message::where('destinataire_id', $user->id)
            ->where('lu', false)->count();

        return view('dashboard.utilisateur', compact(
            'mesRdv',
            'notifications',
            'messagesNonLus'
        ));
    }
}