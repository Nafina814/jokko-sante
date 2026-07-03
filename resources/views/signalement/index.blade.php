<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mes Signalements — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;}
.btn-nav:hover{background:white;}
.hero{background:var(--forest);padding:48px 0;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:2.2rem;font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:10px;}
.hero h1 em{font-style:italic;color:var(--light);}
.main{max-width:800px;margin:0 auto;padding:48px 20px;}
.btn-new{display:inline-flex;align-items:center;gap:8px;background:var(--forest);color:white;border:none;border-radius:50px;padding:12px 28px;font-size:.9rem;font-weight:700;text-decoration:none;transition:all .3s;margin-bottom:28px;}
.btn-new:hover{background:var(--sage);color:white;transform:translateY(-2px);}
.signal-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:24px 28px;margin-bottom:16px;transition:all .3s;}
.signal-card:hover{box-shadow:0 8px 28px rgba(26,61,22,.08);}
.signal-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;gap:12px;}
.signal-cat{display:inline-block;padding:4px 12px;border-radius:50px;font-size:.72rem;font-weight:700;text-transform:uppercase;}
.cat-violence{background:#fee2e2;color:#dc2626;}
.cat-detresse{background:#dbeafe;color:#1e40af;}
.cat-danger{background:#fef3c7;color:#92400e;}
.cat-insecurite{background:#f3e8ff;color:#6b21a8;}
.cat-autre{background:var(--light);color:var(--forest);}
.badge-statut{padding:5px 14px;border-radius:50px;font-size:.75rem;font-weight:700;}
.s-en_attente{background:#fef3c7;color:#92400e;}
.s-pris_en_charge{background:#dbeafe;color:#1e40af;}
.s-traite{background:#dcfce7;color:#166534;}

/* TIMELINE */
.timeline{display:flex;align-items:center;gap:0;margin:16px 0;padding:16px;background:#fafaf8;border-radius:12px;}
.tl-step{display:flex;flex-direction:column;align-items:center;flex:1;position:relative;}
.tl-step:not(:last-child)::after{content:'';position:absolute;top:14px;left:50%;width:100%;height:2px;background:#e0e8dc;z-index:0;}
.tl-step.done:not(:last-child)::after{background:var(--forest);}
.tl-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;z-index:1;border:2px solid #e0e8dc;background:white;}
.tl-step.done .tl-dot{border-color:var(--forest);background:var(--forest);color:white;}
.tl-step.active .tl-dot{border-color:var(--forest);background:white;color:var(--forest);}
.tl-label{font-size:.68rem;color:var(--muted);margin-top:6px;text-align:center;font-weight:500;}
.tl-step.done .tl-label{color:var(--forest);font-weight:700;}

.signal-desc{font-size:.87rem;color:var(--dark);line-height:1.7;margin-bottom:12px;}
.signal-meta{display:flex;gap:16px;flex-wrap:wrap;font-size:.76rem;color:var(--muted);}
.signal-meta span{display:flex;align-items:center;gap:4px;}
.urgence-badge{padding:3px 10px;border-radius:50px;font-size:.7rem;font-weight:700;}
.u-faible{background:#dcfce7;color:#166534;}
.u-moyenne{background:#fef3c7;color:#92400e;}
.u-elevee{background:#fee2e2;color:#dc2626;}
.empty-state{text-align:center;padding:60px 20px;}
.empty-state h3{font-family:'Fraunces',serif;font-size:1.3rem;color:var(--dark);margin-bottom:10px;}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <a href="/dashboard" class="btn-nav">← Mon espace</a>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Mes <em>signalements</em></h1>
    </div>
</div>

<div class="main">

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <a href="{{ route('signalement.create') }}" class="btn-new">
        ➕ Nouveau signalement
    </a>

    @forelse($signalements as $sig)
    <div class="signal-card">
        <div class="signal-header">
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <span class="signal-cat cat-{{ $sig->categorie }}">{{ ucfirst($sig->categorie) }}</span>
                <span class="urgence-badge u-{{ $sig->urgence }}">{{ $sig->libelle_urgence }}</span>
            </div>
            <span class="badge-statut s-{{ $sig->statut }}">{{ $sig->libelle_statut }}</span>
        </div>

        {{-- TIMELINE --}}
        <div class="timeline">
            <div class="tl-step {{ in_array($sig->statut, ['en_attente','pris_en_charge','traite']) ? 'done' : '' }}">
                <div class="tl-dot">✓</div>
                <div class="tl-label">Reçu</div>
            </div>
            <div class="tl-step {{ in_array($sig->statut, ['pris_en_charge','traite']) ? 'done' : ($sig->statut === 'en_attente' ? 'active' : '') }}">
                <div class="tl-dot">{{ in_array($sig->statut, ['pris_en_charge','traite']) ? '✓' : '2' }}</div>
                <div class="tl-label">En cours</div>
            </div>
            <div class="tl-step {{ $sig->statut === 'traite' ? 'done' : '' }}">
                <div class="tl-dot">{{ $sig->statut === 'traite' ? '✓' : '3' }}</div>
                <div class="tl-label">Résolu</div>
            </div>
        </div>

        <p class="signal-desc">{{ Str::limit($sig->description, 200) }}</p>

        <div class="signal-meta">
            <span>📅 {{ $sig->created_at->format('d/m/Y à H:i') }}</span>
            @if($sig->latitude)
                <span>📍 Position GPS enregistrée</span>
            @endif
            @if($sig->photo)
                <span>📷 Photo jointe</span>
            @endif
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div style="font-size:4rem;margin-bottom:16px;">📋</div>
        <h3>Aucun signalement pour le moment</h3>
        <p style="color:var(--muted);font-size:.9rem;">Utilisez le bouton ci-dessus pour signaler une situation.</p>
    </div>
    @endforelse

</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);margin-top:40px;">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Urgence : 116 · 17 · 800 00 19 19</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>