@extends('layouts.app')
@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp
@section('title', 'Témoignage de ' . ($temoignage->anonyme ? 'Anonyme' : $temoignage->auteur->name))

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--mint:#3A6B2F;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}

.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.nav-back{color:rgba(255,255,255,.75);text-decoration:none;font-size:.86rem;font-weight:500;transition:color .25s;}
.nav-back:hover{color:white;}

.hero{background:var(--forest);padding:56px 0;text-align:center;}
.hero .anon-badge{background:rgba(255,255,255,.15);color:var(--light);padding:3px 12px;border-radius:999px;font-size:.68rem;font-weight:700;margin-left:6px;vertical-align:middle;}
.hero h1{font-family:'Fraunces',serif;font-size:clamp(1.8rem,4vw,2.6rem);font-weight:300;color:white;letter-spacing:-.02em;margin:14px 0 8px;}
.hero small{color:rgba(255,255,255,.6);font-size:.85rem;}

.content-section{padding:56px 0;}
.testimony-card{max-width:860px;margin:0 auto 32px;background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:44px;box-shadow:0 20px 50px rgba(26,61,22,.07);}
.testimony-avatar-lg{width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,var(--forest),var(--mint));color:white;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;flex-shrink:0;}
.testimony-body{line-height:1.9;font-size:1.05rem;color:#2a3a28;white-space:pre-line;}

.comments-card{max-width:860px;margin:0 auto;background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:44px;box-shadow:0 20px 50px rgba(26,61,22,.07);}
.comments-card h3{font-family:'Fraunces',serif;font-size:1.3rem;font-weight:600;color:var(--dark);margin-bottom:28px;}
.comment-item{border-bottom:1px solid rgba(0,0,0,.06);padding-bottom:22px;margin-bottom:22px;}
.comment-avatar{width:40px;height:40px;border-radius:50%;background:var(--sage);color:white;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;flex-shrink:0;}
.comment-author{font-weight:600;font-size:.88rem;color:var(--dark);}
.comment-date{font-size:.72rem;color:var(--muted);}
.comment-text{margin-top:10px;font-size:.9rem;color:#2a3a28;line-height:1.7;}

.comment-form textarea.form-control{border:1.5px solid #e0e8dc;border-radius:12px;padding:12px 16px;font-size:.9rem;}
.comment-form textarea.form-control:focus{border-color:var(--sage);box-shadow:0 0 0 .2rem rgba(45,90,39,.12);}
.btn-comment{background:var(--forest);color:white;border:none;border-radius:50px;padding:11px 30px;font-weight:700;font-size:.86rem;transition:all .3s;}
.btn-comment:hover{background:var(--sage);color:white;transform:translateY(-2px);}

footer.jokko-footer{background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);}
</style>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <a href="{{ route('temoignages.index') }}" class="nav-back">← Retour aux témoignages</a>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <div class="container">
        <h1>{{ $temoignage->anonyme ? 'Anonyme' : $temoignage->auteur->name }} @if($temoignage->anonyme)<span class="anon-badge">Anonyme</span>@endif</h1>
        <small>{{ $temoignage->created_at->format('d/m/Y à H:i') }}</small>
    </div>
</div>

<div class="content-section">
    <div class="container">
        <div class="testimony-card">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="testimony-avatar-lg">
                    @if($temoignage->anonyme) ? @else {{ strtoupper(substr($temoignage->auteur->name,0,1)) }} @endif
                </div>
                <div>
                    <div style="font-weight:600;font-size:1rem;color:var(--dark);">{{ $temoignage->anonyme ? 'Anonyme' : $temoignage->auteur->name }}</div>
                    <small class="text-muted">{{ $temoignage->created_at->format('d/m/Y à H:i') }}</small>
                </div>
            </div>
            <div class="testimony-body">{!! nl2br(e($temoignage->contenu)) !!}</div>
        </div>

        <!-- COMMENTAIRES -->
        <div class="comments-card">
            <h3>💬 Commentaires ({{ $temoignage->commentaires->count() }})</h3>

            @forelse($temoignage->commentaires as $commentaire)
            <div class="comment-item">
                <div class="d-flex align-items-center gap-3">
                    <div class="comment-avatar">
                        @if($commentaire->anonyme) ? @else {{ strtoupper(substr($commentaire->auteur->name ?? '',0,1)) }} @endif
                    </div>
                    <div>
                        <span class="comment-author">{{ $commentaire->anonyme ? 'Anonyme' : $commentaire->auteur->name }}</span>
                        <span class="comment-date d-block">{{ $commentaire->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <p class="comment-text">{{ $commentaire->contenu }}</p>
            </div>
            @empty
            <p class="text-muted">Aucun commentaire pour le moment. Soyez le premier !</p>
            @endforelse

            @auth
            @if(auth()->user()->role->nom === 'utilisateur')
            <div class="mt-5 pt-4 border-top comment-form">
                <h5 class="mb-3" style="color:var(--dark);font-weight:600;">Ajouter un commentaire</h5>
                <form method="POST" action="{{ route('temoignages.commentaires.store', $temoignage) }}">
                    @csrf
                    <textarea
                        name="contenu"
                        class="form-control mb-3"
                        rows="4"
                        placeholder="Écrivez votre commentaire ici..."
                        required></textarea>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="anonyme" value="1" class="form-check-input" id="commentAnonyme">
                        <label class="form-check-label" for="commentAnonyme">Publier anonymement</label>
                    </div>

                    <button type="submit" class="btn-comment">Publier le commentaire</button>
                </form>
            </div>
            @endif
            @endauth
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="jokko-footer">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
    </div>
</footer>
@endsection