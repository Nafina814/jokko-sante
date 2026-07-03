<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Résultat PHQ-9 — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--mint:#3A6B2F;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;}

/* RESULT HERO */
.result-hero{padding:60px 0;text-align:center;}
.score-circle{width:160px;height:160px;border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;margin:0 auto 28px;border:6px solid;}
.score-num{font-family:'Fraunces',serif;font-size:3rem;font-weight:600;line-height:1;}
.score-max{font-size:.85rem;font-weight:500;opacity:.7;margin-top:2px;}
.niveau-badge{display:inline-block;padding:8px 24px;border-radius:50px;font-size:.88rem;font-weight:700;margin-bottom:20px;}
.result-title{font-family:'Fraunces',serif;font-size:2rem;font-weight:300;color:var(--dark);letter-spacing:-.03em;margin-bottom:12px;}
.result-recommandation{font-size:1rem;color:var(--muted);max-width:520px;margin:0 auto;line-height:1.8;}

/* COLORS BY NIVEAU */
.minimal         .score-circle{border-color:#16a34a;background:#f0fdf4;} .minimal         .score-num{color:#16a34a;}
.leger           .score-circle{border-color:#ca8a04;background:#fefce8;} .leger           .score-num{color:#ca8a04;}
.modere          .score-circle{border-color:#ea580c;background:#fff7ed;} .modere          .score-num{color:#ea580c;}
.moderement_severe .score-circle{border-color:#dc2626;background:#fef2f2;} .moderement_severe .score-num{color:#dc2626;}
.severe          .score-circle{border-color:#991b1b;background:#fef2f2;} .severe          .score-num{color:#991b1b;}

.niveau-minimal{background:#dcfce7;color:#166534;}
.niveau-leger{background:#fef3c7;color:#92400e;}
.niveau-modere{background:#fed7aa;color:#c2410c;}
.niveau-moderement_severe{background:#fecaca;color:#dc2626;}
.niveau-severe{background:#fee2e2;color:#991b1b;}

/* JAUGE */
.gauge-section{max-width:600px;margin:0 auto 60px;padding:0 20px;}
.gauge-bar{height:12px;border-radius:50px;background:#e5e7eb;overflow:hidden;margin:12px 0;}
.gauge-fill{height:12px;border-radius:50px;transition:width 1.5s ease;}
.gauge-labels{display:flex;justify-content:space-between;font-size:.72rem;color:var(--muted);}

/* DETAILS */
.details-section{padding:0 0 60px;}
.detail-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:28px 32px;margin-bottom:16px;}
.detail-card h3{font-family:'Fraunces',serif;font-size:1.1rem;font-weight:600;color:var(--dark);margin-bottom:20px;}
.reponse-item{display:flex;align-items:flex-start;gap:16px;padding:10px 0;border-bottom:1px solid rgba(0,0,0,.05);}
.reponse-item:last-child{border-bottom:none;}
.rep-score{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;flex-shrink:0;margin-top:2px;}
.rep-0{background:#dcfce7;color:#166534;}
.rep-1{background:#fef3c7;color:#92400e;}
.rep-2{background:#fed7aa;color:#c2410c;}
.rep-3{background:#fecaca;color:#dc2626;}
.rep-text{font-size:.85rem;color:var(--dark);line-height:1.5;}

/* ACTIONS */
.actions-section{text-align:center;padding:20px 0 60px;}
.btn-rdv{display:inline-flex;align-items:center;gap:10px;background:var(--forest);color:white;border:none;border-radius:50px;padding:16px 36px;font-size:.95rem;font-weight:700;text-decoration:none;transition:all .35s;box-shadow:0 8px 28px rgba(26,61,22,.3);margin:8px;}
.btn-rdv:hover{background:var(--sage);color:white;transform:translateY(-3px);}
.btn-retry{display:inline-flex;align-items:center;gap:10px;background:white;color:var(--forest);border:1.5px solid var(--light);border-radius:50px;padding:15px 32px;font-size:.95rem;font-weight:700;text-decoration:none;transition:all .35s;margin:8px;}
.btn-retry:hover{background:var(--light);color:var(--forest);}

/* URGENT BOX */
.urgent-box{background:#fef2f2;border:2px solid #fca5a5;border-radius:20px;padding:28px 32px;text-align:center;margin-bottom:24px;}
.urgent-box h3{font-family:'Fraunces',serif;font-size:1.3rem;color:#dc2626;margin-bottom:10px;}
.urgent-box p{color:#7f1d1d;font-size:.9rem;line-height:1.7;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <a href="/dashboard" class="btn-nav">Mon espace</a>
    </div>
</nav>

<div class="result-hero {{ $test->niveau }}">
    <div class="container">
        <div class="score-circle">
            <span class="score-num">{{ $test->score_total }}</span>
            <span class="score-max">sur 27</span>
        </div>

        <span class="niveau-badge niveau-{{ $test->niveau }}">
            @php
                $niveauLabels = [
                    'minimal'             => '😊 Dépression minimale',
                    'leger'               => '😐 Dépression légère',
                    'modere'              => '😟 Dépression modérée',
                    'moderement_severe'   => '😢 Dépression modérément sévère',
                    'severe'              => '🆘 Dépression sévère',
                ];
            @endphp
            {{ $niveauLabels[$test->niveau] ?? ucfirst($test->niveau) }}
        </span>

        <h2 class="result-title">Votre résultat du {{ $test->created_at->format('d/m/Y') }}</h2>
        <p class="result-recommandation">{{ $test->recommandation }}</p>

        {{-- Jauge --}}
        <div class="gauge-section" style="margin-top:32px;">
            <div class="gauge-bar">
                <div class="gauge-fill" id="gaugeFill"
                     style="width:0%;background:
                        @if($test->niveau === 'minimal') #16a34a
                        @elseif($test->niveau === 'leger') #ca8a04
                        @elseif($test->niveau === 'modere') #ea580c
                        @else #dc2626
                        @endif;">
                </div>
            </div>
            <div class="gauge-labels">
                <span>0 — Minimal</span>
                <span>5 — Léger</span>
                <span>10 — Modéré</span>
                <span>15 — Sévère</span>
                <span>27</span>
            </div>
        </div>
    </div>
</div>

@if(in_array($test->niveau, ['modere', 'moderement_severe', 'severe']))
<div style="background:#fef2f2;border:2px solid #dc2626;border-radius:20px;padding:28px 32px;margin-bottom:24px;">
    <h3 style="font-family:'Fraunces',serif;font-size:1.3rem;color:#dc2626;margin-bottom:10px;">
        🚨 Aide professionnelle recommandée
    </h3>
    <p style="color:#7f1d1d;font-size:.9rem;line-height:1.7;margin-bottom:16px;">
        Votre score indique une dépression <strong>{{ str_replace('_', ' ', $test->niveau) }}</strong>.
        Notre équipe et nos psychologues ont été <strong>alertés automatiquement</strong> et vont vous contacter.
        En attendant, notre assistant IA est disponible pour vous accompagner.
    </p>
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="/assistant" style="display:inline-flex;align-items:center;gap:8px;background:#dc2626;color:white;padding:12px 24px;border-radius:50px;font-weight:700;text-decoration:none;font-size:.88rem;">
            🤖 Parler à l'assistant maintenant
        </a>
        <a href="/rendezvous" style="display:inline-flex;align-items:center;gap:8px;background:var(--forest);color:white;padding:12px 24px;border-radius:50px;font-weight:700;text-decoration:none;font-size:.88rem;">
            📅 Prendre rendez-vous d'urgence
        </a>
        <a href="tel:116" style="display:inline-flex;align-items:center;gap:8px;background:#fee2e2;color:#dc2626;padding:12px 24px;border-radius:50px;font-weight:700;text-decoration:none;font-size:.88rem;border:2px solid #fca5a5;">
            📞 Appeler le 116
        </a>
    </div>
</div>
@endif
    {{-- Détail des réponses --}}
    <div class="details-section">
        <div class="detail-card">
            <h3>📋 Détail de vos réponses</h3>
            @foreach($test->reponses as $reponse)
            <div class="reponse-item">
                <div class="rep-score rep-{{ $reponse->score }}">{{ $reponse->score }}</div>
                <div>
                    <p class="rep-text">{{ $questions[$reponse->question_numero] }}</p>
                    <p style="font-size:.75rem;color:var(--muted);margin-top:3px;">
                        @php
                            $labels = [0=>'Jamais',1=>'Plusieurs jours',2=>'Plus de la moitié du temps',3=>'Presque tous les jours'];
                        @endphp
                        {{ $labels[$reponse->score] }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Actions --}}
    <div class="actions-section">
        <a href="/rendezvous" class="btn-rdv">📅 Prendre rendez-vous</a>
        <a href="{{ route('prevention.index') }}" class="btn-retry">🔄 Refaire le test</a>
        <a href="/assistance" class="btn-retry">💬 Parler à quelqu'un</a>
    </div>

</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
setTimeout(() => {
    const pct = ({{ $test->score_total }} / 27) * 100;
    document.getElementById('gaugeFill').style.width = pct + '%';
}, 300);
</script>
</body>
</html>