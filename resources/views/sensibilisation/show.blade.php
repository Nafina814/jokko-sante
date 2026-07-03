<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $article->titre }} — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;transition:all .3s;}
.btn-nav:hover{background:white;color:var(--forest);}
.article-hero{background:var(--forest);padding:60px 0 40px;}
.article-cat{display:inline-block;padding:5px 16px;border-radius:50px;font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:20px;background:rgba(232,245,228,.15);color:var(--light);}
.article-hero h1{font-family:'Fraunces',serif;font-size:clamp(1.8rem,4vw,3rem);font-weight:300;color:white;letter-spacing:-.03em;line-height:1.2;max-width:700px;}
.article-meta{margin-top:20px;color:rgba(255,255,255,.5);font-size:.84rem;}
.article-body{max-width:760px;margin:0 auto;padding:60px 20px;}
.article-body p{font-size:1.05rem;line-height:1.9;color:#2a3a28;margin-bottom:24px;}
.back-link{display:inline-flex;align-items:center;gap:8px;color:var(--sage);font-size:.88rem;font-weight:600;text-decoration:none;margin-bottom:40px;padding:10px 20px;background:white;border-radius:50px;border:1px solid rgba(0,0,0,.07);transition:all .3s;}
.back-link:hover{background:var(--light);color:var(--forest);}
.cta-box{background:var(--forest);border-radius:20px;padding:40px;text-align:center;margin-top:60px;}
.cta-box h3{font-family:'Fraunces',serif;font-size:1.5rem;color:white;font-weight:300;margin-bottom:12px;}
.cta-box p{color:rgba(255,255,255,.6);font-size:.9rem;margin-bottom:24px;}
.cta-btn{display:inline-block;background:var(--light);color:var(--forest);padding:12px 32px;border-radius:50px;font-weight:700;text-decoration:none;transition:all .3s;}
.cta-btn:hover{background:white;color:var(--forest);}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        @auth
            <a href="/dashboard" class="btn-nav">Mon espace</a>
        @else
            <a href="/register" class="btn-nav">S'inscrire</a>
        @endauth
    </div>
</nav>

<div class="article-hero">
    <div class="container">
        <span class="article-cat">{{ ucfirst($article->categorie) }}</span>
        <h1>{{ $article->titre }}</h1>
        <div class="article-meta">
            Par <strong style="color:rgba(255,255,255,.75);">{{ $article->auteur->name ?? 'Équipe Jokko Santé' }}</strong>
            · {{ $article->created_at->format('d/m/Y') }}
        </div>
    </div>
</div>

<div class="container">
    <div class="article-body">
        <a href="{{ route('sensibilisation.index') }}" class="back-link">← Retour aux articles</a>

        @foreach(explode("\n", $article->contenu) as $paragraph)
            @if(trim($paragraph))
                <p>{{ trim($paragraph) }}</p>
            @endif
        @endforeach

        @guest
        <div class="cta-box">
            <h3>Vous avez besoin d'aide ?</h3>
            <p>Rejoignez Jokko Santé pour accéder à notre assistance, faire le test PHQ-9 et prendre rendez-vous avec un psychologue.</p>
            <a href="/register" class="cta-btn">Rejoindre gratuitement →</a>
        </div>
        @endguest
    </div>
</div>

{{-- SECTION COMMENTAIRES --}}
<div class="container">
    <div style="max-width:760px;margin:0 auto;padding:0 20px 60px;">

        <div style="border-top:1px solid rgba(26,61,22,.1);padding-top:40px;margin-top:20px;">

            <h3 style="font-family:'Fraunces',serif;font-size:1.3rem;font-weight:600;color:var(--dark);margin-bottom:24px;display:flex;align-items:center;gap:10px;">
                💬 Commentaires
                <span style="background:var(--light);color:var(--sage);font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:999px;font-family:'DM Sans',sans-serif;">
                    {{ $article->commentaires->count() }}
                </span>
            </h3>

            {{-- Formulaire — utilisateur uniquement --}}
            @auth
                @if(Auth::user()->role->nom === 'utilisateur')
                <div style="background:white;border-radius:16px;border:1px solid rgba(26,61,22,.08);padding:24px;margin-bottom:28px;">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;">
                        <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--forest),var(--mint));display:flex;align-items:center;justify-content:center;color:white;font-size:.76rem;font-weight:700;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <div style="font-size:.86rem;font-weight:600;color:var(--dark);">{{ Auth::user()->name }}</div>
                    </div>
                    <form method="POST" action="{{ route('commentaires.store', $article->id) }}">
                        @csrf
                        <textarea name="contenu"
                            placeholder="Partagez votre réaction sur cet article..."
                            required minlength="3"
                            style="width:100%;padding:12px 16px;border:1.5px solid #dce8d8;border-radius:12px;font-size:.88rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;resize:vertical;min-height:90px;line-height:1.7;"></textarea>
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;flex-wrap:wrap;gap:10px;">
                            <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:.82rem;color:var(--muted);">
                                <input type="checkbox" name="anonyme" value="1" style="accent-color:var(--forest);width:16px;height:16px;">
                                🔒 Commenter anonymement
                            </label>
                            <button type="submit"
                                style="background:var(--forest);color:white;border:none;border-radius:50px;padding:10px 22px;font-size:.85rem;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;">
                                Publier →
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div style="background:#f0f9ed;border:1px solid #c8e6c0;border-radius:12px;padding:14px;text-align:center;margin-bottom:24px;">
                    <p style="color:var(--sage);font-size:.86rem;">Seuls les utilisateurs inscrits peuvent laisser des commentaires.</p>
                </div>
                @endif
            @else
            <div style="background:#f0f9ed;border:1px solid #c8e6c0;border-radius:12px;padding:14px;text-align:center;margin-bottom:24px;">
                <p style="color:var(--sage);font-size:.86rem;">
                    <a href="/login" style="color:var(--forest);font-weight:700;">Connectez-vous</a> pour laisser un commentaire.
                </p>
            </div>
            @endauth

            {{-- Liste commentaires --}}
            @forelse($article->commentaires()->with('auteur')->latest()->get() as $commentaire)
            <div style="background:white;border-radius:14px;border:1px solid rgba(26,61,22,.07);padding:20px;margin-bottom:12px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#2563eb);display:flex;align-items:center;justify-content:center;color:white;font-size:.72rem;font-weight:700;flex-shrink:0;">
                            {{ $commentaire->anonyme ? '?' : strtoupper(substr($commentaire->auteur->name ?? 'A', 0, 2)) }}
                        </div>
                        <div>
                            <div style="font-size:.84rem;font-weight:600;color:var(--dark);">
                                {{ $commentaire->anonyme ? 'Anonyme' : ($commentaire->auteur->name ?? 'Utilisateur') }}
                                @if($commentaire->anonyme)
                                    <span style="background:var(--light);color:var(--sage);padding:2px 8px;border-radius:999px;font-size:.66rem;font-weight:700;margin-left:4px;">Anonyme</span>
                                @endif
                            </div>
                            <div style="font-size:.72rem;color:var(--muted);">{{ $commentaire->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    {{-- Supprimer --}}
                    @auth
                        @if(Auth::id() === $commentaire->user_id || Auth::user()->role->nom === 'admin')
                        <form method="POST" action="{{ route('commentaires.destroy', $commentaire->id) }}"
                              onsubmit="return confirm('Supprimer ce commentaire ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none;border:none;cursor:pointer;color:#e5e7eb;padding:4px;border-radius:6px;transition:color .2s;"
                                    onmouseover="this.style.color='#ef4444'" onmouseout="this.style.color='#e5e7eb'">
                                🗑️
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
                <p style="font-size:.86rem;color:#2a3a28;line-height:1.75;margin:0;">{{ $commentaire->contenu }}</p>
            </div>
            @empty
            <div style="text-align:center;padding:32px;background:white;border-radius:14px;border:1px solid rgba(26,61,22,.07);">
                <p style="color:var(--muted);font-size:.86rem;">Aucun commentaire pour le moment. Soyez le premier à réagir !</p>
            </div>
            @endforelse

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