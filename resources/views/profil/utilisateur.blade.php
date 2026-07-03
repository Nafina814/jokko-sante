<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mon Profil — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;}
.hero{background:var(--forest);padding:48px 0;}
.hero-inner{display:flex;align-items:center;gap:28px;}
.hero-avatar{width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-family:'Fraunces',serif;font-size:2.2rem;font-weight:600;color:white;flex-shrink:0;border:3px solid rgba(255,255,255,.3);}
.hero-name{font-family:'Fraunces',serif;font-size:1.8rem;font-weight:300;color:white;margin-bottom:6px;}
.hero-role{display:inline-block;background:rgba(232,245,228,.2);color:var(--light);padding:4px 14px;border-radius:50px;font-size:.78rem;font-weight:700;}
.hero-info{color:rgba(255,255,255,.5);font-size:.84rem;margin-top:8px;}
.main{max-width:860px;margin:0 auto;padding:48px 20px;}
.stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:24px;}
.stat-item{background:white;border-radius:14px;padding:20px;text-align:center;border:1px solid rgba(0,0,0,.06);border-top:3px solid var(--forest);}
.stat-num{font-family:'Fraunces',serif;font-size:2rem;font-weight:600;color:var(--forest);line-height:1;}
.stat-lbl{font-size:.75rem;color:var(--muted);margin-top:6px;}
.section-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);overflow:hidden;margin-bottom:24px;}
.section-header{padding:22px 28px;border-bottom:1px solid rgba(0,0,0,.07);display:flex;align-items:center;gap:12px;}
.section-header h2{font-family:'Fraunces',serif;font-size:1.05rem;font-weight:600;color:var(--dark);margin:0;}
.section-body{padding:28px;}
label{display:block;font-size:.8rem;font-weight:600;color:var(--dark);margin-bottom:7px;}
input[type=text],input[type=email],input[type=password],select{width:100%;padding:12px 16px;border:1.5px solid #e0e8dc;border-radius:12px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;transition:border-color .25s;}
input:focus,select:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.1);background:white;}
input[readonly]{background:#f5f5f5;color:var(--muted);cursor:not-allowed;}
.field{margin-bottom:18px;}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.btn-save{background:var(--forest);color:white;border:none;border-radius:12px;padding:12px 28px;font-size:.9rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;}
.btn-save:hover{background:var(--sage);transform:translateY(-2px);}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.alert-err{background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.quick-links{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:24px;}
.quick-link{background:white;border-radius:14px;border:1px solid rgba(0,0,0,.07);padding:16px;text-decoration:none;display:flex;align-items:center;gap:10px;transition:all .3s;}
.quick-link:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(26,61,22,.1);border-color:var(--light);}
.quick-link-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;background:var(--light);}
.quick-link h4{font-size:.84rem;font-weight:600;color:var(--dark);margin:0 0 2px;}
.quick-link p{font-size:.72rem;color:var(--muted);margin:0;}
.confidentialite-box{background:var(--light);border-radius:16px;padding:20px 24px;margin-bottom:24px;border:1px solid rgba(26,61,22,.1);}
.confidentialite-box h3{font-size:.9rem;font-weight:600;color:var(--forest);margin-bottom:12px;}
.conf-item{display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid rgba(26,61,22,.08);font-size:.84rem;color:var(--dark);}
.conf-item:last-child{border-bottom:none;}
.conf-ok{color:#16a34a;font-weight:700;font-size:.78rem;}
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
        <div class="hero-inner">
            <div class="hero-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
            <div>
                <div class="hero-name">{{ $user->name }}</div>
                <span class="hero-role">
                    {{ $user->genre === 'femme' ? '👩 Femme' : ($user->genre === 'homme' ? '🎓 Étudiant' : '🌿 Utilisateur') }}
                </span>
                <div class="hero-info">
                    📧 {{ $user->email }}
                    @if($user->universite) · 🎓 {{ $user->universite }} @endif
                    · Membre depuis {{ $user->created_at->format('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main">

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-err">
            @foreach($errors->all() as $e)<div>❌ {{ $e }}</div>@endforeach
        </div>
    @endif

    {{-- STATS UTILISATEUR --}}
    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-num">{{ $stats['tests'] }}</div>
            <div class="stat-lbl">🧪 Tests PHQ-9</div>
        </div>
        <div class="stat-item" style="border-top-color:#3b82f6;">
            <div class="stat-num" style="color:#3b82f6;">{{ $stats['rendezvous'] }}</div>
            <div class="stat-lbl">📅 Rendez-vous</div>
        </div>
        <div class="stat-item" style="border-top-color:#a855f7;">
            <div class="stat-num" style="color:#a855f7;">{{ $stats['forums'] }}</div>
            <div class="stat-lbl">💬 Discussions</div>
        </div>
    </div>

    {{-- ACCÈS RAPIDES --}}
    <p style="font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:14px;">Mes services</p>
    <div class="quick-links">
        <a href="/prevention" class="quick-link">
            <div class="quick-link-icon">🧪</div>
            <div><h4>Test PHQ-9</h4><p>Évaluer mon état</p></div>
        </a>
        <a href="/rendezvous" class="quick-link">
            <div class="quick-link-icon">📅</div>
            <div><h4>Rendez-vous</h4><p>Mes consultations</p></div>
        </a>
        <a href="/assistance" class="quick-link">
            <div class="quick-link-icon">💬</div>
            <div><h4>Assistance</h4><p>Forum & messages</p></div>
        </a>
    </div>

    {{-- CONFIDENTIALITE --}}
    <div class="confidentialite-box">
        <h3>🛡️ Vos données sont protégées</h3>
        <div class="conf-item">
            <span>🔒 Données chiffrées</span>
            <span class="conf-ok">✅ Actif</span>
        </div>
        <div class="conf-item">
            <span>👤 Mode anonyme disponible</span>
            <span class="conf-ok">✅ Disponible</span>
        </div>
        <div class="conf-item">
            <span>🧪 Résultats PHQ-9 privés</span>
            <span class="conf-ok">✅ Privé</span>
        </div>
    </div>

    {{-- INFOS PERSONNELLES --}}
    <div class="section-card">
        <div class="section-header">
            <span style="font-size:1.2rem;">👤</span>
            <h2>Mes informations personnelles</h2>
        </div>
        <div class="section-body">
            <form method="POST" action="{{ route('profil.update') }}">
                @csrf @method('PUT')
                <div class="row2">
                    <div class="field">
                        <label>Nom complet</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input type="email" value="{{ $user->email }}" readonly>
                    </div>
                </div>
                <div class="row2">
                    <div class="field">
                        <label>Genre</label>
                        <select name="genre" required>
                            <option value="homme" {{ $user->genre=='homme'?'selected':'' }}>Homme</option>
                            <option value="femme" {{ $user->genre=='femme'?'selected':'' }}>Femme</option>
                            <option value="autre" {{ $user->genre=='autre'?'selected':'' }}>Autre</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}" placeholder="+221 XX XXX XX XX">
                    </div>
                </div>
                <div class="field">
                    <label>Université</label>
                    <input type="text" name="universite" value="{{ old('universite', $user->universite) }}" placeholder="Ex: UCAD, UGB, UNIPRO...">
                </div>
                <div style="text-align:right;">
                    <button type="submit" class="btn-save">💾 Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MOT DE PASSE --}}
    <div class="section-card">
        <div class="section-header">
            <span style="font-size:1.2rem;">🔒</span>
            <h2>Changer le mot de passe</h2>
        </div>
        <div class="section-body">
            <form method="POST" action="{{ route('profil.password') }}">
                @csrf @method('PUT')
                <div class="field">
                    <label>Mot de passe actuel</label>
                    <input type="password" name="current_password" placeholder="••••••••" required>
                </div>
                <div class="row2">
                    <div class="field">
                        <label>Nouveau mot de passe</label>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                    <div class="field">
                        <label>Confirmer</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>
                <div style="text-align:right;">
                    <button type="submit" class="btn-save">💾 Modifier</button>
                </div>
            </form>
        </div>
    </div>

</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>