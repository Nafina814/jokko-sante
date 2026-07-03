<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rendez-vous — Jokko Santé</title>
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
.btn-nav:hover{background:white;}
.nav-link-c{color:rgba(255,255,255,.7);text-decoration:none;font-size:.88rem;margin-left:24px;transition:color .25s;}
.nav-link-c:hover{color:white;}
.hero{background:var(--forest);padding:56px 0 40px;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:2.5rem;font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:12px;}
.hero h1 em{font-style:italic;color:var(--light);}
.hero p{color:rgba(255,255,255,.65);font-size:.95rem;max-width:500px;margin:0 auto;line-height:1.8;}
.main-section{padding:56px 0;}
.section-title{font-family:'Fraunces',serif;font-size:1.4rem;font-weight:600;color:var(--dark);margin-bottom:20px;letter-spacing:-.02em;}
.eyebrow{font-size:.72rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--sage);display:block;margin-bottom:8px;}

/* PSYCHOLOGUE CARDS */
.psycho-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:24px;height:100%;transition:all .35s;}
.psycho-card:hover{transform:translateY(-6px);box-shadow:0 20px 48px rgba(26,61,22,.12);}
.psycho-avatar{width:56px;height:56px;border-radius:50%;background:var(--forest);display:flex;align-items:center;justify-content:center;color:white;font-size:1.1rem;font-weight:700;margin-bottom:14px;}
.psycho-name{font-family:'Fraunces',serif;font-size:1.05rem;font-weight:600;color:var(--dark);margin-bottom:4px;}
.psycho-role{font-size:.78rem;color:var(--sage);font-weight:600;margin-bottom:16px;}
.btn-select{width:100%;background:var(--light);color:var(--forest);border:1.5px solid rgba(26,61,22,.15);border-radius:12px;padding:10px;font-size:.84rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .25s;}
.btn-select:hover,.btn-select.selected{background:var(--forest);color:white;border-color:var(--forest);}

/* FORM */
.form-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:32px;margin-top:32px;}
label{display:block;font-size:.82rem;font-weight:600;color:var(--dark);margin-bottom:8px;letter-spacing:.02em;}
input[type=datetime-local],textarea,select{width:100%;padding:12px 16px;border:1.5px solid #e0e8dc;border-radius:12px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;transition:border-color .25s;}
input:focus,textarea:focus,select:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.1);background:white;}
textarea{resize:vertical;min-height:100px;}
.field{margin-bottom:20px;}
.btn-submit{background:var(--forest);color:white;border:none;border-radius:50px;padding:14px 40px;font-size:.95rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;box-shadow:0 6px 20px rgba(26,61,22,.25);}
.btn-submit:hover{background:var(--sage);transform:translateY(-2px);}

/* MES RDV */
.rdv-card{background:white;border-radius:16px;border:1px solid rgba(0,0,0,.07);padding:20px 24px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;gap:16px;}
.badge-s{padding:5px 14px;border-radius:50px;font-size:.74rem;font-weight:700;}
.s-attente{background:#fef3c7;color:#92400e;}
.s-confirme{background:#dcfce7;color:#166534;}
.s-annule{background:#fee2e2;color:#dc2626;}
.s-termine{background:#f1f5f9;color:#64748b;}
.btn-annuler{background:#fee2e2;color:#dc2626;border:none;border-radius:8px;padding:7px 14px;font-size:.78rem;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .25s;}
.btn-annuler:hover{background:#fecaca;}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:14px 18px;margin-bottom:24px;font-size:.88rem;}
.alert-err{background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:14px 18px;margin-bottom:24px;font-size:.88rem;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <div class="d-flex align-items-center">
            <a href="/sensibilisation" class="nav-link-c">Sensibilisation</a>
            <a href="/prevention" class="nav-link-c">Prévention</a>
            <a href="/assistance" class="nav-link-c">Assistance</a>
            <a href="/dashboard" class="btn-nav" style="margin-left:16px;">Mon espace</a>
        </div>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Prendre <em>rendez-vous</em></h1>
        <p>Consultez un psychologue partenaire en toute confidentialité. Choisissez votre professionnel et réservez votre créneau.</p>
    </div>
</div>

<div class="main-section">
    <div class="container">

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-err">
                @foreach($errors->all() as $e)<div>❌ {{ $e }}</div>@endforeach
            </div>
        @endif

        {{-- PSYCHOLOGUES --}}
        <span class="eyebrow">Étape 1</span>
        <h2 class="section-title">Choisissez votre psychologue</h2>

        @if($psychologues->count() > 0)
        <div class="row g-4" id="psychoGrid">
            @foreach($psychologues as $psycho)
            <div class="col-md-6 col-lg-3">
                <div class="psycho-card" id="card-psycho-{{ $psycho->id }}">
                    <div class="psycho-avatar">{{ strtoupper(substr($psycho->name, 0, 2)) }}</div>
                    <div class="psycho-name">Dr. {{ $psycho->name }}</div>
                    <div class="psycho-role">🩺 Psychologue</div>
                    @if($psycho->universite)
                        <p style="font-size:.78rem;color:var(--muted);margin-bottom:16px;">{{ $psycho->universite }}</p>
                    @endif
                    <button type="button" class="btn-select" onclick="selectPsycho({{ $psycho->id }}, '{{ $psycho->name }}')">
                        Choisir ce psychologue
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <div style="background:var(--light);border-radius:16px;padding:32px;text-align:center;margin-bottom:32px;">
                <p style="color:var(--sage);font-size:.9rem;">Aucun psychologue disponible pour le moment.</p>
            </div>
        @endif

        {{-- FORMULAIRE --}}
        <div class="form-card" id="formSection" style="{{ $psychologues->count() > 0 ? '' : 'display:none' }}">
            <span class="eyebrow">Étape 2</span>
            <h2 class="section-title" style="margin-bottom:24px;">Choisissez votre créneau</h2>

            <form method="POST" action="{{ route('rendezvous.store') }}">
                @csrf
                <input type="hidden" name="psychologue_id" id="psychologueId" value="{{ old('psychologue_id') }}">

                <div id="selectedPsychoInfo" style="background:var(--light);border-radius:12px;padding:14px 18px;margin-bottom:24px;display:none;">
                    <p style="font-size:.85rem;font-weight:600;color:var(--forest);margin:0;">✅ Psychologue sélectionné : <span id="selectedName"></span></p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="field">
                            <label>Date et heure du rendez-vous</label>
                            <input type="datetime-local" name="date_heure"
                                   value="{{ old('date_heure') }}"
                                   min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                                   required>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label>Motif de la consultation <span style="color:var(--muted);font-weight:400">(optionnel)</span></label>
                    <textarea name="motif" placeholder="Décrivez brièvement le motif de votre consultation...">{{ old('motif') }}</textarea>
                </div>

                <button type="submit" class="btn-submit">📅 Confirmer la demande</button>
            </form>
        </div>

        {{-- MES RDV --}}
        @if($mesRdv->count() > 0)
        <div style="margin-top:56px;">
            <span class="eyebrow">Historique</span>
            <h2 class="section-title">Mes rendez-vous</h2>
            @foreach($mesRdv as $rdv)
            <div class="rdv-card">
                <div>
                    <p style="font-weight:600;font-size:.9rem;color:var(--dark);margin:0;">Dr. {{ $rdv->psychologue->name }}</p>
                    <p style="font-size:.8rem;color:var(--muted);margin:4px 0;">
                        📅 {{ $rdv->date_heure->format('d/m/Y à H:i') }}
                    </p>
                    @if($rdv->motif)
                        <p style="font-size:.76rem;color:var(--muted);margin:0;font-style:italic;">{{ Str::limit($rdv->motif, 60) }}</p>
                    @endif
                </div>
                <div style="display:flex;align-items:center;gap:10px;flex-shrink:0;">
                    <span class="badge-s s-{{ $rdv->statut }}">
                        @php $labels = ['en_attente'=>'⏳ En attente','confirme'=>'✅ Confirmé','annule'=>'❌ Annulé','termine'=>'🏁 Terminé']; @endphp
                        {{ $labels[$rdv->statut] ?? $rdv->statut }}
                    </span>
                    @if($rdv->statut === 'en_attente')
                    <form method="POST" action="{{ route('rendezvous.annuler', $rdv) }}">
                        @csrf
                        <button type="submit" class="btn-annuler"
                                onclick="return confirm('Annuler ce rendez-vous ?')">
                            Annuler
                        </button>
                    </form>
                    @endif
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
function selectPsycho(id, name) {
    document.querySelectorAll('.btn-select').forEach(b => {
        b.textContent = 'Choisir ce psychologue';
        b.classList.remove('selected');
    });
    const btn = document.querySelector('#card-psycho-' + id + ' .btn-select');
    btn.textContent = '✅ Sélectionné';
    btn.classList.add('selected');
    document.getElementById('psychologueId').value = id;
    document.getElementById('selectedName').textContent = 'Dr. ' + name;
    document.getElementById('selectedPsychoInfo').style.display = 'block';
    document.getElementById('formSection').style.display = 'block';
    document.getElementById('formSection').scrollIntoView({behavior: 'smooth', block: 'start'});
}
</script>
</body>
</html>