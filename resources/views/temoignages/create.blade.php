@extends('layouts.app')
@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp
@section('title','Partager un témoignage')

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

.hero{background:var(--forest);padding:72px 0;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:16px;}
.hero h1 em{font-style:italic;color:var(--light);}
.hero p{color:rgba(255,255,255,.65);font-size:1rem;max-width:520px;margin:0 auto;line-height:1.8;}

.form-section{padding:60px 0;}
.form-card{max-width:760px;margin:0 auto;background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:48px;box-shadow:0 20px 50px rgba(26,61,22,.08);}
.form-label{font-weight:600;color:var(--dark);font-size:.88rem;margin-bottom:8px;}
.form-control, textarea.form-control{border:1.5px solid #e0e8dc;border-radius:12px;padding:12px 16px;font-size:.92rem;transition:all .25s;}
.form-control:focus{border-color:var(--sage);box-shadow:0 0 0 .2rem rgba(45,90,39,.12);}
.form-check-input:checked{background-color:var(--forest);border-color:var(--forest);}
.btn-submit{background:var(--forest);color:white;border:none;border-radius:50px;padding:12px 34px;font-weight:700;font-size:.9rem;transition:all .3s;}
.btn-submit:hover{background:var(--sage);color:white;transform:translateY(-2px);}
.btn-cancel{background:var(--cream);color:var(--dark);border:1.5px solid #e0e8dc;border-radius:50px;padding:12px 26px;font-weight:600;font-size:.9rem;text-decoration:none;transition:all .25s;}
.btn-cancel:hover{background:#eef4ea;color:var(--dark);}

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
        <h1>Partager votre <em>témoignage</em></h1>
        <p>Votre témoignage sera modéré avant publication. Merci de contribuer à briser les tabous autour de la santé mentale.</p>
    </div>
</div>

<div class="form-section">
    <div class="container">
        <div class="form-card">
            <form method="POST" action="{{ route('temoignages.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Votre témoignage</label>
                    <textarea name="contenu" rows="10" class="form-control @error('contenu') is-invalid @enderror" required>{{ old('contenu') }}</textarea>
                    @error('contenu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-check mb-4">
                    <input type="checkbox" name="anonyme" value="1" class="form-check-input" id="anonymeCheck" {{ old('anonyme') ? 'checked' : '' }}>
                    <label class="form-check-label" for="anonymeCheck">Publier anonymement</label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('temoignages.index') }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">Soumettre le témoignage</button>
                </div>
            </form>
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