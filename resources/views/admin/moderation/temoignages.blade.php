@extends('layouts.app')
@php
    $hideNavbar = true;
    $hideFooter = true;
@endphp
@section('title', 'Modération des témoignages')

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

.hero{background:var(--forest);padding:64px 0 96px;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:clamp(2rem,4vw,2.9rem);font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:14px;}
.hero p{color:rgba(255,255,255,.65);font-size:1rem;max-width:560px;margin:0 auto;line-height:1.8;}

.stats-wrap{margin-top:-56px;position:relative;z-index:2;margin-bottom:44px;}
.stat-card{background:white;border-radius:16px;padding:26px 28px;box-shadow:0 15px 40px rgba(26,61,22,.12);border-left:4px solid var(--accent,var(--forest));height:100%;}
.stat-card .number{font-family:'Fraunces',serif;font-size:2.6rem;font-weight:600;color:var(--accent,var(--dark));line-height:1;}
.stat-card .label{margin-top:8px;font-size:.82rem;font-weight:500;color:var(--accent,var(--muted));}

.table-wrap{padding-bottom:70px;}
.table-container{background:white;border-radius:20px;overflow:hidden;border:1px solid rgba(0,0,0,.07);box-shadow:0 15px 40px rgba(26,61,22,.08);}
.table thead th{background:#f8fdf6;font-weight:600;color:var(--forest);padding:18px 16px;font-size:.82rem;text-transform:uppercase;letter-spacing:.04em;border-bottom:1px solid rgba(0,0,0,.06);}
.table td{padding:20px 16px;vertical-align:middle;border-color:rgba(0,0,0,.05);}
.testimony-row:hover{background:#f0f9ed;}
.badge-pub{background:#dcfce7;color:#166534;padding:5px 14px;border-radius:50px;font-size:.75rem;font-weight:700;}
.badge-att{background:#fef3c7;color:#92400e;padding:5px 14px;border-radius:50px;font-size:.75rem;font-weight:700;}
.badge-rej{background:#fee2e2;color:#991b1b;padding:5px 14px;border-radius:50px;font-size:.75rem;font-weight:700;}
.btn-approve{background:var(--forest);color:white;border:none;border-radius:50px;padding:8px 18px;font-size:.8rem;font-weight:700;transition:all .25s;}
.btn-approve:hover{background:var(--sage);color:white;}
.btn-reject{background:white;color:#b91c1c;border:1.5px solid #fecaca;border-radius:50px;padding:8px 18px;font-size:.8rem;font-weight:700;transition:all .25s;}
.btn-reject:hover{background:#fee2e2;color:#991b1b;}

footer.jokko-footer{background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);}
</style>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <a href="{{ route('dashboard') }}" class="nav-back">← Retour au dashboard</a>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <div class="container">
        <h1>Modération des <em style="font-style:italic;color:var(--light);">témoignages</em></h1>
        <p>Validez ou rejetez les témoignages soumis par la communauté</p>
    </div>
</div>

<div class="container" style="max-width:1200px;">

    <!-- STATISTIQUES -->
    <div class="stats-wrap row g-4">
        <div class="col-md-4">
            <div class="stat-card" style="--accent:#92400e;">
                <div class="number">{{ $temoignages->where('statut','en_attente')->count() }}</div>
                <div class="label">En attente</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="--accent:#166534;">
                <div class="number">{{ $temoignages->where('statut','publie')->count() }}</div>
                <div class="label">Publiés</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="--accent:#991b1b;">
                <div class="number">{{ $temoignages->where('statut','rejete')->count() }}</div>
                <div class="label">Rejetés</div>
            </div>
        </div>
    </div>

    <!-- TABLEAU -->
    <div class="table-wrap">
        <div class="table-container">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($temoignages as $temoignage)
                    <tr class="testimony-row">
                        <td>
                            @if($temoignage->anonyme)
                                <strong>Anonyme</strong>
                            @else
                                {{ $temoignage->auteur->name }}
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($temoignage->contenu, 140) }}</small>
                        </td>
                        <td>{{ $temoignage->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($temoignage->statut == 'publie')
                                <span class="badge-pub">Publié</span>
                            @elseif($temoignage->statut == 'en_attente')
                                <span class="badge-att">En attente</span>
                            @else
                                <span class="badge-rej">Rejeté</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @if($temoignage->statut == 'en_attente')
                                <form method="POST" action="{{ route('admin.temoignages.publier', $temoignage) }}" class="d-inline">
                                    @csrf
                                    <button class="btn-approve me-2">
                                        <i data-lucide="check"></i> Publier
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.temoignages.rejeter', $temoignage) }}" class="d-inline">
                                    @csrf
                                    <button class="btn-reject">
                                        <i data-lucide="x"></i> Rejeter
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            Aucun témoignage à modérer pour le moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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