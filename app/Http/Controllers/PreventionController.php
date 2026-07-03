<?php

namespace App\Http\Controllers;

use App\Models\TestPhq9;
use App\Models\ReponsePhq9;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventionController extends Controller
{
    // Les 9 questions du PHQ-9
    private array $questions = [
        1  => "Peu d'intérêt ou de plaisir à faire les choses",
        2  => "Se sentir triste, déprimé(e) ou sans espoir",
        3  => "Difficultés à s'endormir, rester endormi(e) ou dormir trop",
        4  => "Se sentir fatigué(e) ou manquer d'énergie",
        5  => "Peu d'appétit ou manger en excès",
        6  => "Se sentir coupable ou nul(le) — avoir l'impression d'avoir déçu sa famille",
        7  => "Difficultés à se concentrer (lecture, télévision...)",
        8  => "Bouger ou parler si lentement que les autres l'ont remarqué — ou au contraire être si agité(e) que vous bougez beaucoup plus que d'habitude",
        9  => "Penser qu'il vaudrait mieux mourir ou se faire du mal d'une façon ou d'une autre",
    ];

    public function index()
    {
        $this->middleware_auth();
        $historique = TestPhq9::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();
        return view('prevention.index', [
            'questions'  => $this->questions,
            'historique' => $historique,
        ]);
    }

    public function store(Request $request)
{
    $this->middleware_auth();

    $rules = [];
    foreach (range(1, 9) as $i) {
        $rules["question_$i"] = 'required|integer|between:0,3';
    }
    $request->validate($rules);

    // Calcul score
    $scoreTotal = 0;
    for ($i = 1; $i <= 9; $i++) {
        $scoreTotal += (int) $request->input("question_$i");
    }

    $niveau         = TestPhq9::calculerNiveau($scoreTotal);
    $recommandation = TestPhq9::calculerRecommandation($niveau);

    $test = TestPhq9::create([
        'user_id'        => Auth::id(),
        'score_total'    => $scoreTotal,
        'niveau'         => $niveau,
        'recommandation' => $recommandation,
    ]);

    for ($i = 1; $i <= 9; $i++) {
        ReponsePhq9::create([
            'test_id'         => $test->id,
            'question_numero' => $i,
            'score'           => (int) $request->input("question_$i"),
        ]);
    }

    // Notifier UNIQUEMENT les admins et psychologues — PAS les pair-aidants
if (in_array($niveau, ['modere', 'moderement_severe', 'severe'])) {
    $user = Auth::user();

    // Admins uniquement
    $admins = \App\Models\User::whereHas('role', fn($q) =>
        $q->where('nom', 'admin')
    )->get();

    foreach ($admins as $admin) {
        \App\Models\NotificationPlateforme::create([
            'user_id' => $admin->id,
            'titre'   => '🚨 ALERTE — Dépression détectée',
            'message' => sprintf(
                'L\'utilisateur %s (%s) a un score PHQ-9 de %d/27 — Niveau : %s. Tél: %s.',
                $user->name,
                $user->email,
                $scoreTotal,
                strtoupper(str_replace('_', ' ', $niveau)),
                $user->telephone ?? 'Non renseigné'
            ),
            'type' => 'alerte',
        ]);
    }

    // Psychologues uniquement — PAS les pair-aidants
    $psychologues = \App\Models\User::whereHas('role', fn($q) =>
        $q->where('nom', 'psychologue')
    )->get();

    foreach ($psychologues as $psycho) {
        \App\Models\NotificationPlateforme::create([
            'user_id' => $psycho->id,
            'titre'   => '🚨 Patient nécessitant attention urgente',
            'message' => sprintf(
                '%s — Score PHQ-9 : %d/27 (niveau %s). Prise en charge recommandée.',
                $user->name,
                $scoreTotal,
                strtoupper(str_replace('_', ' ', $niveau))
            ),
            'type' => 'alerte',
        ]);
    }
}

    return redirect()->route('prevention.resultat', $test->id);
}
    public function resultat(TestPhq9 $test)
    {
        $this->middleware_auth();

        if ($test->user_id !== Auth::id()) {
            abort(403);
        }

        $test->load('reponses');

        return view('prevention.resultat', [
            'test'      => $test,
            'questions' => $this->questions,
        ]);
    }

    private function middleware_auth()
    {
        if (!Auth::check()) {
            redirect()->route('login')->send();
        }
    }
}