<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mes Rendez-vous — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--mint:#3A6B2F;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F5F9F4;}
.sidebar{position:fixed;top:0;left:0;width:260px;height:100vh;background:var(--forest);display:flex;flex-direction:column;z-index:100;}
.sidebar-brand{padding:28px 24px;border-bottom:1px solid rgba(255,255,255,.08);}
.sidebar-brand a{font-family:'Fraunces',serif;font-size:1.4rem;font-weight:600;color:white;text-decoration:none;}
.sidebar-brand a span{color:var(--light);}
.sidebar-brand p{color:rgba(255,255,255,.4);font-size:.75rem;margin-top:4px;}
.sidebar-nav{padding:20px 0;flex:1;}
.nav-section{padding:8px 24px;font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-top:12px;}
.nav-item a{display:flex;align-items:center;gap:12px;padding:11px 24px;color:rgba(255,255,255,.65);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .25s;}
.nav-item a:hover{background:rgba(255,255,255,.07);color:white;}
.nav-item a.active{background:rgba(255,255,255,.1);color:white;border-right:3px solid var(--light);}
.nav-item a .icon{font-size:1rem;width:20px;text-align:center;}
.sidebar-footer{padding:20px 24px;border-top:1px solid rgba(255,255,255,.08);}
.main{margin-left:260px;min-height:100vh;}
.topbar{background:white;padding:16px 32px;border-bottom:1px solid rgba(0,0,0,.07);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar h1{font-family:'Fraunces',serif;font-size:1.3rem;font-weight:600;color:var(--dark);margin:0;}
.avatar{width:38px;height:38px;border-radius:50%;background:var(--forest);display:flex;align-items:center;justify-content:center;color:white;font-size:.82rem;font-weight:700;}
.content{padding:32px;}
.stat-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:32px;}
.stat-card{background:white;border-radius:16px;padding:22px 24px;border:1px solid rgba(0,0,0,.06);border-left:4px solid var(--forest);}
.stat-card .num{font-family:'Fraunces',serif;font-size:2.2rem;font-weight:600;color:var(--forest);line-height:1;}
.stat-card .lbl{font-size:.8rem;color:var(--muted);margin-top:8px;}
.section-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.06);overflow:hidden;margin-bottom:24px;}
.section-header{padding:18px 24px;border-bottom:1px solid rgba(0,0,0,.06);}
.section-header h2{font-family:'Fraunces',serif;font-size:1.05rem;color:var(--dark);margin:0;font-weight:600;}
.rdv-row{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid rgba(0,0,0,.05);gap:12px;}
.rdv-row:last-child{border-bottom:none;}
.rdv-row:hover{background:#fafaf8;}
.patient-avatar{width:38px;height:38px;border-radius:50%;background:var(--light);display:flex;align-items:center;justify-content:center;color:var(--forest);font-size:.78rem;font-weight:700;flex-shrink:0;}
.badge-s{padding:5px 12px;border-radius:50px;font-size:.74rem;font-weight:700;}
.s-attente{background:#fef3c7;color:#92400e;}
.s-confirme{background:#dcfce7;color:#166534;}
.s-termine{background:#f1f5f9;color:#64748b;}
.s-annule{background:#fee2e2;color:#dc2626;}
.btn-action{border:none;border-radius:8px;padding:7px 14px;font-size:.78rem;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .25s;margin-left:6px;}
.btn-confirmer{background:#dcfce7;color:#166534;}
.btn-confirmer:hover{background:#bbf7d0;}
.btn-terminer{background:var(--light);color:var(--forest);}
.btn-terminer:hover{background:#c5dfc0;}
.btn-annuler{background:#fee2e2;color:#dc2626;}
.btn-annuler:hover{background:#fecaca;}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:24px;font-size:.88rem;}
.empty{text-align:center;padding:32px;color:var(--muted);font-size:.88rem;}
</style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-brand">
        <a href="/">🌿 Jokko<span>Santé</span></a>
        <p>Espace Psychologue</p>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <div class="nav-item"><a href="/dashboard"><span class="icon">📊</span> Tableau de bord</a></div>
        
        
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;width:100%;text-align:left;padding:0;">
                <span style="display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.5);font-size:.84rem;font-family:'DM Sans',sans-serif;">🚪 Déconnexion</span>
            </button>
        </form>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <h1>Mes rendez-vous</h1>
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:.84rem;color:var(--muted);">Dr. {{ Auth::user()->name }}</span>
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="stat-cards">
            <div class="stat-card">
                <div class="num">{{ $rdvEnAttente->count() }}</div>
                <div class="lbl">⏳ En attente</div>
            </div>
            <div class="stat-card" style="border-left-color:#16a34a;">
                <div class="num" style="color:#16a34a;">{{ $rdvConfirmes->count() }}</div>
                <div class="lbl">✅ Confirmés</div>
            </div>
            <div class="stat-card" style="border-left-color:#64748b;">
                <div class="num" style="color:#64748b;">{{ $rdvTermines->count() }}</div>
                <div class="lbl">🏁 Terminés / Annulés</div>
            </div>
        </div>

        {{-- EN ATTENTE --}}
        <div class="section-card">
            <div class="section-header">
                <h2>⏳ Demandes en attente ({{ $rdvEnAttente->count() }})</h2>
            </div>
            @forelse($rdvEnAttente as $rdv)
            <div class="rdv-row">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="patient-avatar">{{ strtoupper(substr($rdv->patient->name, 0, 2)) }}</div>
                    <div>
                        <p style="font-weight:600;font-size:.88rem;color:var(--dark);margin:0;">{{ $rdv->patient->name }}</p>
                        <p style="font-size:.78rem;color:var(--muted);margin:3px 0;">📅 {{ $rdv->date_heure->format('d/m/Y à H:i') }}</p>
                        @if($rdv->motif)
                            <p style="font-size:.75rem;color:var(--muted);margin:0;font-style:italic;">{{ Str::limit($rdv->motif, 50) }}</p>
                        @endif
                    </div>
                </div>
                <div style="display:flex;align-items:center;">
                    <form method="POST" action="{{ route('psychologue.rendezvous.confirmer', $rdv) }}">
                        @csrf
                        <button type="submit" class="btn-action btn-confirmer">✅ Confirmer</button>
                    </form>
                    <form method="POST" action="{{ route('psychologue.rendezvous.annuler', $rdv) }}">
                        @csrf
                        <button type="submit" class="btn-action btn-annuler"
                                onclick="return confirm('Annuler ce rendez-vous ?')">❌ Refuser</button>
                    </form>
                </div>
            </div>
            @empty
                <div class="empty">Aucune demande en attente</div>
            @endforelse
        </div>

        {{-- CONFIRMES --}}
        <div class="section-card">
            <div class="section-header">
                <h2>✅ Rendez-vous confirmés ({{ $rdvConfirmes->count() }})</h2>
            </div>
            @forelse($rdvConfirmes as $rdv)
            <div class="rdv-row">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="patient-avatar">{{ strtoupper(substr($rdv->patient->name, 0, 2)) }}</div>
                    <div>
                        <p style="font-weight:600;font-size:.88rem;color:var(--dark);margin:0;">{{ $rdv->patient->name }}</p>
                        <p style="font-size:.78rem;color:var(--muted);margin:3px 0;">📅 {{ $rdv->date_heure->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
                <div style="display:flex;align-items:center;">
                    <span class="badge-s s-confirme">✅ Confirmé</span>
                    <form method="POST" action="{{ route('psychologue.rendezvous.terminer', $rdv) }}" style="margin-left:8px;">
                        @csrf
                        <button type="submit" class="btn-action btn-terminer">🏁 Terminer</button>
                    </form>
                </div>
            </div>
            @empty
                <div class="empty">Aucun rendez-vous confirmé</div>
            @endforelse
        </div>

        {{-- HISTORIQUE --}}
        @if($rdvTermines->count() > 0)
        <div class="section-card">
            <div class="section-header">
                <h2>🏁 Historique récent</h2>
            </div>
            @foreach($rdvTermines as $rdv)
            <div class="rdv-row">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="patient-avatar">{{ strtoupper(substr($rdv->patient->name, 0, 2)) }}</div>
                    <div>
                        <p style="font-weight:600;font-size:.88rem;color:var(--dark);margin:0;">{{ $rdv->patient->name }}</p>
                        <p style="font-size:.78rem;color:var(--muted);margin:3px 0;">📅 {{ $rdv->date_heure->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
                <span class="badge-s s-{{ $rdv->statut }}">
                    {{ $rdv->statut === 'termine' ? '🏁 Terminé' : '❌ Annulé' }}
                </span>
            </div>
            @endforeach
        </div>
        @endif

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>