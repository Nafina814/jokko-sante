<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Test PHQ-9 — Jokko Santé</title>
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
.btn-nav:hover{background:white;color:var(--forest);}
.nav-link-c{color:rgba(255,255,255,.7);text-decoration:none;font-size:.88rem;margin-left:24px;transition:color .25s;}
.nav-link-c:hover{color:white;}

/* HERO */
.hero{background:var(--forest);padding:56px 0 40px;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:2.5rem;font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:12px;}
.hero h1 em{font-style:italic;color:var(--light);}
.hero p{color:rgba(255,255,255,.65);font-size:.95rem;max-width:540px;margin:0 auto;line-height:1.8;}

/* PROGRESS */
.progress-bar-wrap{background:rgba(255,255,255,.15);border-radius:50px;height:6px;margin-top:24px;max-width:400px;margin-left:auto;margin-right:auto;overflow:hidden;}
.progress-bar-fill{height:6px;background:var(--light);border-radius:50px;transition:width .4s ease;width:0%;}

/* FORM */
.test-section{padding:56px 0;}
.question-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:32px 36px;margin-bottom:20px;transition:all .3s;}
.question-card:hover{box-shadow:0 8px 32px rgba(26,61,22,.08);}
.question-num{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:var(--forest);color:white;font-size:.8rem;font-weight:700;margin-bottom:14px;}
.question-text{font-size:1rem;font-weight:500;color:var(--dark);margin-bottom:20px;line-height:1.5;}

/* RADIO OPTIONS */
.options-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;}
.option-item input{display:none;}
.option-label{display:flex;flex-direction:column;align-items:center;gap:6px;padding:14px 8px;border-radius:14px;border:1.5px solid #e0e8dc;cursor:pointer;transition:all .25s;background:#fafaf8;text-align:center;}
.option-label:hover{border-color:var(--sage);background:rgba(45,90,39,.04);}
.option-item input:checked + .option-label{border-color:var(--forest);background:var(--light);}
.option-score{font-size:1.4rem;font-weight:700;color:var(--forest);}
.option-text{font-size:.72rem;color:var(--muted);font-weight:500;line-height:1.3;}

/* SUBMIT */
.submit-section{text-align:center;padding:40px 0 60px;}
.btn-submit{display:inline-flex;align-items:center;gap:12px;background:var(--forest);color:white;border:none;border-radius:50px;padding:18px 48px;font-size:1rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .35s;box-shadow:0 8px 28px rgba(26,61,22,.3);}
.btn-submit:hover{background:var(--sage);transform:translateY(-3px);box-shadow:0 16px 40px rgba(26,61,22,.35);}
.btn-submit .arrow{width:24px;height:24px;background:rgba(255,255,255,.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.8rem;}

/* INFO BOX */
.info-box{background:var(--light);border-radius:16px;padding:20px 24px;margin-bottom:36px;border:1px solid rgba(26,61,22,.1);}
.info-box p{font-size:.85rem;color:var(--sage);margin:0;line-height:1.6;}

/* HISTORIQUE */
.historique-section{padding:0 0 60px;}
.hist-card{background:white;border-radius:16px;border:1px solid rgba(0,0,0,.07);padding:20px 24px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;}
.hist-badge{padding:5px 14px;border-radius:50px;font-size:.75rem;font-weight:700;}
.niveau-minimal{background:#dcfce7;color:#166534;}
.niveau-leger{background:#fef3c7;color:#92400e;}
.niveau-modere{background:#fed7aa;color:#c2410c;}
.niveau-moderement_severe{background:#fecaca;color:#dc2626;}
.niveau-severe{background:#fee2e2;color:#991b1b;}
.hist-link{color:var(--sage);font-size:.82rem;font-weight:600;text-decoration:none;}
.hist-link:hover{color:var(--forest);}

/* ERROR */
.alert-err{background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:14px 18px;margin-bottom:24px;font-size:.88rem;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <div class="d-flex align-items-center">
            <a href="/sensibilisation" class="nav-link-c">Sensibilisation</a>
            <a href="/assistance" class="nav-link-c">Assistance</a>
            <a href="/dashboard" class="btn-nav" style="margin-left:16px;">Mon espace</a>
        </div>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Test de dépistage <em>PHQ-9</em></h1>
        <p>Ce questionnaire validé cliniquement vous aide à évaluer vos symptômes dépressifs. Répondez honnêtement — vos réponses restent strictement confidentielles.</p>
        <div class="progress-bar-wrap">
            <div class="progress-bar-fill" id="progressBar"></div>
        </div>
    </div>
</div>

<div class="test-section">
    <div class="container" style="max-width:760px;">

        <div class="info-box">
            <p>📋 <strong>Instructions :</strong> Au cours des <strong>2 dernières semaines</strong>, à quelle fréquence avez-vous été gêné(e) par les problèmes suivants ?</p>
        </div>

        @if($errors->any())
            <div class="alert-err">
                ❌ Veuillez répondre à <strong>toutes les questions</strong> avant de soumettre le test.
            </div>
        @endif

        <form method="POST" action="{{ route('prevention.store') }}" id="phqForm">
            @csrf

            @foreach($questions as $num => $question)
            <div class="question-card" id="card-{{ $num }}">
                <div class="question-num">{{ $num }}</div>
                <p class="question-text">{{ $question }}</p>
                <div class="options-grid">
                    @php
                        $options = [
                            0 => 'Jamais',
                            1 => 'Plusieurs jours',
                            2 => 'Plus de la moitié du temps',
                            3 => 'Presque tous les jours',
                        ];
                    @endphp
                    @foreach($options as $val => $label)
                    <div class="option-item">
                        <input type="radio" name="question_{{ $num }}" id="q{{ $num }}_{{ $val }}" value="{{ $val }}"
                               {{ old("question_$num") == $val ? 'checked' : '' }}
                               onchange="updateProgress()">
                        <label for="q{{ $num }}_{{ $val }}" class="option-label">
                            <span class="option-score">{{ $val }}</span>
                            <span class="option-text">{{ $label }}</span>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="submit-section">
                <button type="submit" class="btn-submit">
                    Voir mon résultat
                    <span class="arrow">→</span>
                </button>
                <p style="color:var(--muted);font-size:.8rem;margin-top:16px;">Vos réponses sont confidentielles et sécurisées</p>
            </div>
        </form>

        @if($historique->count() > 0)
        <div class="historique-section">
            <p style="font-size:.75rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;">Mes tests précédents</p>
            @foreach($historique as $hist)
            <div class="hist-card">
                <div>
                    <p style="font-weight:600;font-size:.88rem;color:var(--dark);margin:0;">Score : {{ $hist->score_total }}/27</p>
                    <p style="font-size:.78rem;color:var(--muted);margin:3px 0 0;">{{ $hist->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <div style="display:flex;align-items:center;gap:12px;">
                    <span class="hist-badge niveau-{{ $hist->niveau }}">{{ ucfirst(str_replace('_', ' ', $hist->niveau)) }}</span>
                    <a href="{{ route('prevention.resultat', $hist->id) }}" class="hist-link">Voir →</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif

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
function updateProgress() {
    const total = 9;
    const answered = document.querySelectorAll('input[type=radio]:checked').length;
    const pct = (answered / total) * 100;
    document.getElementById('progressBar').style.width = pct + '%';
}
updateProgress();
</script>
</body>
</html>