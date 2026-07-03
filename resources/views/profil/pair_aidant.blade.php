<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mon Profil Pair-aidant — Jokko Santé</title>
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
.btn-nav:hover{background:white;}
.hero{background:var(--forest);padding:48px 0;}
.hero-inner{display:flex;align-items:center;gap:28px;}
.hero-avatar{width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-family:'Fraunces',serif;font-size:2.2rem;font-weight:600;color:white;flex-shrink:0;border:3px solid rgba(255,255,255,.3);}
.hero-name{font-family:'Fraunces',serif;font-size:1.8rem;font-weight:300;color:white;margin-bottom:6px;}
.hero-role{display:inline-block;background:rgba(232,245,228,.15);color:var(--light);padding:4px 14px;border-radius:50px;font-size:.78rem;font-weight:700;border:1px solid rgba(232,245,228,.3);}
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
input[type=text],input[type=email],input[type=password],textarea,select{width:100%;padding:12px 16px;border:1.5px solid #e0e8dc;border-radius:12px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;transition:border-color .25s;}
input:focus,textarea:focus,select:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.1);background:white;}
input[readonly]{background:#f5f5f5;color:var(--muted);cursor:not-allowed;}
.field{margin-bottom:18px;}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.btn-save{background:var(--forest);color:white;border:none;border-radius:12px;padding:12px 28px;font-size:.9rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;}
.btn-save:hover{background:var(--sage);transform:translateY(-2px);}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.alert-err{background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.forum-link{display:inline-flex;align-items:center;gap:8px;background:var(--light);color:var(--forest);border-radius:12px;padding:12px 22px;font-size:.88rem;font-weight:700;text-decoration:none;transition:all .3s;border:1px solid rgba(26,61,22,.15);}
.forum-link:hover{background:#c5dfc0;transform:translateY(-2px);}
.engagement-box{background:var(--forest);border-radius:16px;padding:24px;margin-bottom:24px;display:flex;align-items:center;gap:16px;}
.engagement-box-icon{font-size:2.5rem;flex-shrink:0;}
.engagement-box h3{font-family:'Fraunces',serif;font-size:1rem;color:white;margin-bottom:6px;font-weight:300;}
.engagement-box p{font-size:.82rem;color:rgba(255,255,255,.65);margin:0;line-height:1.6;}
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
                <span class="hero-role">🤝 Pair-aidant · Badienou Gokh</span>
                <div class="hero-info">
                    📧 {{ $user->email }} · Membre depuis {{ $user->created_at->format('d/m/Y') }}
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

    <div class="engagement-box">
        <div class="engagement-box-icon">🌿</div>
        <div>
            <h3>Merci pour votre engagement communautaire</h3>
            <p>En tant que pair-aidant et Badienou Gokh, vous jouez un rôle essentiel dans notre communauté. Votre présence et votre soutien font une vraie différence.</p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-num">{{ $stats['forums'] }}</div>
            <div class="stat-lbl">💬 Discussions créées</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $stats['reponses'] }}</div>
            <div class="stat-lbl">✍️ Réponses publiées</div>
        </div>
        <div class="stat-item">
            <div class="stat-num">{{ $stats['messages'] }}</div>
            <div class="stat-lbl">📨 Messages envoyés</div>
        </div>
    </div>

    <div style="margin-bottom:24px;">
        <a href="/assistance" class="forum-link">💬 Accéder au forum communautaire →</a>
    </div>

    <div class="section-card">
        <div class="section-header">
            <span style="font-size:1.2rem;">🤝</span>
            <h2>Mon profil de pair-aidant</h2>
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
                        <label>Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}" placeholder="+221 XX XXX XX XX">
                    </div>
                    <div class="field">
                        <label>Genre</label>
                        <select name="genre">
                            <option value="homme" {{ $user->genre=='homme'?'selected':'' }}>Homme</option>
                            <option value="femme" {{ $user->genre=='femme'?'selected':'' }}>Femme</option>
                            <option value="autre" {{ $user->genre=='autre'?'selected':'' }}>Autre</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label>Quartier / Zone d'intervention</label>
                    <input type="text" name="universite" value="{{ old('universite', $user->universite) }}" placeholder="Ex: Médina, Pikine, Parcelles Assainies...">
                </div>
                <div style="text-align:right;">
                    <button type="submit" class="btn-save">💾 Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="section-card">
        <div class="section-header">
            <span style="font-size:1.2rem;">🔒</span>
            <h2>Sécurité du compte</h2>
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
                    <button type="submit" class="btn-save">🔒 Modifier</button>
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