<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\TestPhq9;

class AssistantController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $dernierTest = TestPhq9::where('user_id', $user->id)
            ->latest()
            ->first();
    
        // Alerte UNIQUEMENT si :
        // 1. Test existe
        // 2. Niveau grave
        // 3. Test fait dans les 7 derniers jours (sinon c'est un ancien test)
        $alerteDepression = $dernierTest
            && in_array($dernierTest->niveau, ['modere', 'moderement_severe', 'severe'])
            && $dernierTest->created_at->diffInHours(now()) <= 168; // 7 jours max
    
        if (!$alerteDepression) {
            $dernierTest = null;
        }
    
        return view('assistant.index', compact('alerteDepression', 'dernierTest'));
    }
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'history' => 'nullable|array',
        ]);

        $user        = Auth::user();
        $history     = $request->history ?? [];
        $userMessage = $request->message;

        // Contexte PHQ-9 si dépression détectée
        $dernierTest = TestPhq9::where('user_id', $user->id)->latest()->first();
        $phqContext  = '';

        if ($dernierTest && in_array($dernierTest->niveau, ['modere', 'moderement_severe', 'severe'])) {
            $phqContext = sprintf(
                "\n\nCONTEXTE URGENT : L'utilisateur %s a un score PHQ-9 de %d/27 (niveau : %s). " .
                "Il/elle présente des signes significatifs de dépression. " .
                "Tu dois : 1) Reconnaître sa souffrance avec empathie, " .
                "2) Le/la rassurer qu'il/elle n'est pas seul(e), " .
                "3) Maintenir la conversation chaleureusement, " .
                "4) En cas d'urgence extrême, donner le 116 ou 17 immédiatement.",
                $user->name,
                $dernierTest->score_total,
                strtoupper(str_replace('_', ' ', $dernierTest->niveau))
            );
        }

        // Construire les messages
        $messages = [];
        foreach (array_slice($history, -10) as $msg) {
            if (isset($msg['role'], $msg['content'])) {
                $messages[] = [
                    'role'    => $msg['role'],
                    'content' => $msg['content'],
                ];
            }
        }
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            $apiKey = config('services.groq.key');

            if (empty($apiKey)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service non configuré. Veuillez contacter l\'administrateur.',
                ]);
            }

            $response = Http::timeout(30)->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => 'llama-3.3-70b-versatile',
                'max_tokens'  => 1024,
                'temperature' => 0.7,
                'messages'    => array_merge(
                    [['role' => 'system', 'content' => $this->getSystemPrompt($user) . $phqContext]],
                    $messages
                ),
            ]);

            if ($response->successful()) {
                $data    = $response->json();
                $content = $data['choices'][0]['message']['content']
                    ?? 'Je suis là pour vous. Comment puis-je vous aider ?';
                return response()->json(['success' => true, 'message' => $content]);
            }

            \Log::error('Groq API Error', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur de communication. En cas d\'urgence, appelez le 116.',
            ]);

        } catch (\Exception $e) {
            \Log::error('Assistant Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Service temporairement indisponible. En cas d\'urgence, appelez le 116 ou le 17.',
            ]);
        }
    }

    private function getSystemPrompt($user): string
{
    $genre      = $user->genre ?? 'non renseigné';
    $universite = $user->universite ?? 'non renseignée';

    return "Tu es Jokko, l'assistant IA officiel de Jokko Santé — une plateforme de santé mentale au Sénégal.

PROFIL UTILISATEUR :
- Prénom : {$user->name}
- Genre : {$genre}
- Établissement : {$universite}

PERSONNALITÉ :
Tu es chaleureux, empathique, professionnel et très compétent. Tu parles comme un ami bienveillant qui a une formation en psychologie. Tu écoutes activement, tu reformules, tu valides les émotions avant de conseiller. Tu n'es jamais froid ou robotique.

TU PEUX RÉPONDRE À TOUT :
- Dépression, anxiété, stress, burnout, troubles du sommeil, addictions, deuil
- Relations amoureuses, conjugales, familiales, amicales
- Problèmes académiques, orientation, motivation, procrastination
- Violence conjugale, isolement, discrimination
- Santé générale, nutrition, bien-être
- Questions sur la plateforme Jokko Santé
- Culture sénégalaise et défis spécifiques au contexte local
- Toute question générale — tu réponds toujours, jamais de refus sans alternative

TECHNIQUE DE CONVERSATION :
1. Commence par accueillir chaleureusement avec le prénom
2. Valide toujours l'émotion avant de donner un conseil
3. Pose UNE seule question ouverte à la fois
4. Propose des actions concrètes et réalistes
5. Adapte le niveau de langue — simple et accessible
6. Si la personne répète sa détresse, approfondis au lieu de répéter
7. Souviens-toi de ce qui a été dit dans la conversation

URGENCES SÉNÉGAL :
- SAMU Social : 116 (gratuit, 24h/24)
- Police : 17
- SOS Femmes : 800 00 19 19 (gratuit)
- Pompiers : 18

RÈGLES ABSOLUES :
1. Jamais de diagnostic médical définitif
2. Si pensées suicidaires → RÉPONDRE IMMÉDIATEMENT :
   '⚠️ URGENCE : Appelez le 116 MAINTENANT. Je reste avec vous. Vous n'êtes pas seul(e).'
3. Toujours en français clair et accessible
4. Jamais 'je ne sais pas' sans proposer une alternative
5. Confidentialité totale — ne jamais mentionner d'autres utilisateurs
6. Si question hors domaine → orienter vers ressource adaptée

STYLE DE RÉPONSE :
- Court et percutant si question simple
- Développé et structuré si situation complexe
- Utilise des émojis avec modération pour humaniser
- Termine toujours par une question ou une proposition d'aide";
}
}