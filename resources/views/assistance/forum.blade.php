<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $forum->titre }} — Jokko Santé</title>
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
.hero{background:var(--forest);padding:48px 0 36px;}
.hero-tag{display:inline-block;background:rgba(232,245,228,.15);color:var(--light);padding:4px 14px;border-radius:50px;font-size:.75rem;font-weight:700;margin-bottom:14px;}
.hero h1{font-family:'Fraunces',serif;font-size:clamp(1.6rem,3vw,2.4rem);font-weight:300;color:white;letter-spacing:-.03em;max-width:700px;line-height:1.25;}
.hero-meta{color:rgba(255,255,255,.5);font-size:.82rem;margin-top:14px;}
.main-content{max-width:760px;margin:0 auto;padding:48px 20px;}
.back-link{display:inline-flex;align-items:center;gap:8px;color:var(--sage);font-size:.86rem;font-weight:600;text-decoration:none;margin-bottom:28px;padding:9px 18px;background:white;border-radius:50px;border:1px solid rgba(0,0,0,.07);transition:all .3s;}
.back-link:hover{background:var(--light);color:var(--forest);}
.post-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:28px 32px;margin-bottom:16px;}
.post-card.original{border-left:4px solid var(--forest);}
.post-header{display:flex;align-items:center;gap:12px;margin-bottom:16px;}
.post-avatar{width:38px;height:38px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:.78rem;font-weight:700;flex-shrink:0;background:var(--forest);}
.post-avatar.rep{background:#3b82f6;}
.post-name{font-weight:600;font-size:.88rem;color:var(--dark);}
.post-date{font-size:.76rem;color:var(--muted);}
.post-content{font-size:.92rem;color:#2a3a28;line-height:1.8;}
.reply-section{margin-top:32px;}
.reply-title{font-family:'Fraunces',serif;font-size:1.1rem;font-weight:600;color:var(--dark);margin-bottom:20px;}
.reply-form{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:28px 32px;margin-top:24px;}
label{display:block;font-size:.8rem;font-weight:600;color:var(--dark);margin-bottom:7px;}
textarea{width:100%;padding:12px 16px;border:1.5px solid #e0e8dc;border-radius:12px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;transition:border-color .25s;resize:vertical;min-height:120px;}
textarea:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.1);background:white;}
.check-row{display:flex;align-items:center;gap:8px;margin:14px 0 18px;}
.check-row input{accent-color:var(--sage);width:15px;height:15px;}
.check-row label{font-size:.84rem;color:var(--muted);margin:0;}
.btn-submit{background:var(--forest);color:white;border:none;border-radius:50px;padding:12px 28px;font-size:.9rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;}
.btn-submit:hover{background:var(--sage);transform:translateY(-2px);}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.badge-anon{background:rgba(232,245,228,.5);color:var(--sage);padding:2px 10px;border-radius:50px;font-size:.7rem;font-weight:700;margin-left:6px;}
.no-replies{text-align:center;padding:32px;color:var(--muted);font-size:.88rem;background:white;border-radius:16px;border:1px solid rgba(0,0,0,.06);}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <a href="/dashboard" class="btn-nav">Mon espace</a>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <span class="hero-tag">💬 Discussion communautaire</span>
        <h1>{{ $forum->titre }}</h1>
        <div class="hero-meta">
            Publié par <strong style="color:rgba(255,255,255,.75);">
                {{ $forum->anonyme ? 'Anonyme' : ($forum->auteur->name ?? 'Utilisateur') }}
            </strong>
            · {{ $forum->created_at->format('d/m/Y à H:i') }}
            · {{ $forum->reponses->count() }} réponse(s)
        </div>
    </div>
</div>

<div class="main-content">

    @if(session('success'))
        <div class="alert-success">✅ {{ session('success') }}</div>
    @endif

    <a href="{{ route('assistance.index') }}" class="back-link">← Retour au forum</a>

    {{-- POST ORIGINAL --}}
    <div class="post-card original">
        <div class="post-header">
            <div class="post-avatar">
                {{ $forum->anonyme ? '?' : strtoupper(substr($forum->auteur->name ?? 'A', 0, 2)) }}
            </div>
            <div>
                <div class="post-name">
                    {{ $forum->anonyme ? 'Anonyme' : ($forum->auteur->name ?? 'Utilisateur') }}
                    @if($forum->anonyme)<span class="badge-anon">Anonyme</span>@endif
                </div>
                <div class="post-date">{{ $forum->created_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>
        <div class="post-content">
            @foreach(explode("\n", $forum->contenu) as $paragraph)
                @if(trim($paragraph))<p style="margin-bottom:12px;">{{ trim($paragraph) }}</p>@endif
            @endforeach
        </div>
    </div>

    {{-- RÉPONSES --}}
    <div class="reply-section">
        <p class="reply-title">💬 {{ $forum->reponses->count() }} réponse(s)</p>

        @forelse($forum->reponses as $reponse)
        <div class="post-card">
            <div class="post-header">
                <div class="post-avatar rep">
                    {{ $reponse->anonyme ? '?' : strtoupper(substr($reponse->auteur->name ?? 'A', 0, 2)) }}
                </div>
                <div>
                    <div class="post-name">
                        {{ $reponse->anonyme ? 'Anonyme' : ($reponse->auteur->name ?? 'Utilisateur') }}
                        @if($reponse->anonyme)<span class="badge-anon">Anonyme</span>@endif
                    </div>
                    <div class="post-date">{{ $reponse->created_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>
            <div class="post-content">{{ $reponse->contenu }}</div>
        </div>
        @empty
        <div class="no-replies">
            Aucune réponse pour le moment — soyez le premier à répondre !
        </div>
        @endforelse

        {{-- FORMULAIRE RÉPONSE --}}
        <div class="reply-form">
            <p style="font-family:'Fraunces',serif;font-size:1rem;font-weight:600;color:var(--dark);margin-bottom:16px;">✏️ Votre réponse</p>
            <form method="POST" action="{{ route('assistance.forum.reponse', $forum) }}">
                @csrf
                <div>
                    <label>Répondre à cette discussion</label>
                    <textarea name="contenu" placeholder="Partagez votre expérience, votre conseil ou votre soutien..." required></textarea>
                </div>
                <div class="check-row">
                    <input type="checkbox" name="anonyme" id="rep-anon" value="1">
                    <label for="rep-anon">Répondre anonymement</label>
                </div>
                <button type="submit" class="btn-submit">🌿 Publier ma réponse</button>
            </form>
        </div>
    </div>

</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);margin-top:40px;">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>