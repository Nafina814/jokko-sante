<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Espace Psychologue — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root { 
  --forest:#1A3D16; --sage:#2D5A27; --mint:#3A6B2F; 
  --light:#E8F5E4; --dark:#0f2410; --muted:#6b7568; 
}
*,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'DM Sans',sans-serif; background:#F5F9F4; }
body.menu-open { overflow:hidden; }

/* MOBILE TOPBAR */
.mobile-topbar{
  display:none;
  position:fixed;
  top:0;
  left:0;
  right:0;
  height:72px;
  background:white;
  border-bottom:1px solid #e5ede0;
  z-index:120;
  padding:0 16px;
  align-items:center;
  gap:14px;
  box-shadow:0 6px 20px rgba(0,0,0,.05);
}
.hamburger-btn{
  width:44px;
  height:44px;
  border:none;
  border-radius:12px;
  background:#f0f9ed;
  color:var(--forest);
  display:flex;
  align-items:center;
  justify-content:center;
  cursor:pointer;
}
.hamburger-btn i{ width:22px; height:22px; }
.mobile-brand{
  text-decoration:none;
  display:flex;
  align-items:center;
  gap:8px;
  font-family:'Fraunces',serif;
  font-size:1.1rem;
  font-weight:600;
  color:var(--forest);
}
.mobile-brand span{ color:var(--mint); }
.mobile-brand i{ width:22px; height:22px; }

.sidebar-overlay{
  position:fixed;
  inset:0;
  background:rgba(15,36,16,.45);
  z-index:95;
  opacity:0;
  visibility:hidden;
  transition:all .3s ease;
}

/* SIDEBAR */
.sidebar { 
  position:fixed; top:0; left:0; width:260px; height:100vh; 
  background:white; border-right:1px solid #e5ede0;
  display:flex; flex-direction:column; z-index:100; 
  box-shadow: 2px 0 10px rgba(0,0,0,0.06);
}
.sidebar-brand { 
  padding:28px 24px; border-bottom:1px solid #e5ede0;
}
.sidebar-brand a { 
  font-family:'Fraunces',serif; font-size:1.45rem; font-weight:600; 
  color:var(--forest); text-decoration:none; display:flex; align-items:center; gap:8px;
}
.sidebar-brand a span { color:var(--mint); }

.sidebar-nav{
  padding:20px 0;
  flex:1;
  overflow-y:auto;
}

.nav-section { 
  padding:8px 24px 4px; font-size:.7rem; font-weight:700; 
  letter-spacing:.1em; text-transform:uppercase; color:var(--sage); margin-top:12px; 
}
.nav-item a { 
  display:flex; align-items:center; gap:14px; padding:12px 24px; 
  color:var(--forest); text-decoration:none; font-size:.92rem; 
  font-weight:500; transition:all .25s; border-radius:0 8px 8px 0; margin:2px 8px;
}
.nav-item a:hover, .nav-item a.active { 
  background:#f0f9ed; color:var(--mint); font-weight:600;
}
.nav-item a i { width:20px; height:20px; color:var(--sage); }

.sidebar-footer { 
  margin-top:auto; padding:20px 24px; border-top:1px solid #e5ede0;
}
.sidebar-footer a { 
  display:flex; align-items:center; gap:12px; color:var(--forest); 
  text-decoration:none; padding:10px 0; font-size:.9rem;
}
.sidebar-footer a:hover { color:var(--mint); }

/* MAIN */
.main { margin-left:260px; min-height:100vh; }
.content { padding:32px; }

.welcome-banner { 
  background:var(--forest); border-radius:20px; padding:32px 36px; 
  margin-bottom:32px; 
}
.stat-cards { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:32px; }
.stat-card { 
  background:white; border-radius:16px; padding:22px 24px; 
  border:1px solid rgba(0,0,0,.06); border-left:4px solid var(--forest); 
}
.stat-card .num{
  font-family:'Fraunces',serif;
  font-size:2rem;
  font-weight:600;
  color:var(--forest);
}
.stat-card .lbl{
  font-size:.85rem;
  color:var(--muted);
  margin-top:8px;
}

.dashboard-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:24px;
  margin-bottom:24px;
}

.card-section { background:white; border-radius:20px; border:1px solid rgba(0,0,0,.06); overflow:hidden; margin-bottom:24px; }
.card-section-header { padding:20px 24px; border-bottom:1px solid rgba(0,0,0,.06); display:flex; align-items:center; justify-content:space-between; gap:12px; }
.card-section-header h2 { font-family:'Fraunces',serif; font-size:1.05rem; color:var(--dark); margin:0; font-weight:600; }
.card-section-body { padding:24px; }

.rdv-item { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:14px 0; border-bottom:1px solid rgba(0,0,0,.05); }
.rdv-item:last-child { border-bottom:none; }

.badge-statut{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  padding:8px 12px;
  border-radius:999px;
  font-size:.76rem;
  font-weight:700;
  white-space:nowrap;
}
.badge-confirme{
  background:#dcfce7;
  color:#166534;
}

.notif-item{
  display:flex;
  align-items:flex-start;
  gap:12px;
  padding:12px 0;
  border-bottom:1px solid rgba(0,0,0,.05);
}
.notif-item:last-child{ border-bottom:none; }
.notif-dot{
  width:10px;
  height:10px;
  border-radius:50%;
  background:var(--mint);
  margin-top:6px;
  flex-shrink:0;
}

@media (max-width: 1100px){
  .stat-cards{
    grid-template-columns:1fr;
  }
}

@media (max-width: 991px){
  .mobile-topbar{ display:flex; }

  .sidebar{
    transform:translateX(-100%);
    transition:transform .3s ease;
    width:280px;
  }

  .sidebar.open{
    transform:translateX(0);
  }

  .sidebar-overlay.show{
    opacity:1;
    visibility:visible;
  }

  .main{
    margin-left:0;
    padding-top:72px;
  }

  .content{
    padding:20px 16px 28px;
  }

  .welcome-banner{
    padding:24px 20px;
  }

  .stat-cards,
  .dashboard-grid{
    grid-template-columns:1fr;
  }

  .rdv-item{
    align-items:flex-start;
    flex-direction:column;
  }
}
</style>
</head>
<body>

<div class="mobile-topbar">
    <button class="hamburger-btn" id="hamburgerBtn" aria-label="Ouvrir le menu">
        <i data-lucide="menu"></i>
    </button>
    <a href="/" class="mobile-brand">
        <i data-lucide="leaf"></i>
        Jokko<span>Santé</span>
    </a>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="/">
            <i data-lucide="leaf" style="width:28px;height:28px;"></i>
            Jokko<span style="color:var(--mint);">Santé</span>
        </a>
        <p style="color:var(--sage); font-size:0.8rem; margin-top:4px;">Espace Psychologue</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <div class="nav-item">
            <a href="/dashboard" class="active">
                <i data-lucide="layout-dashboard"></i>
                Tableau de bord
            </a>
        </div>

        <div class="nav-section">Mes patients</div>
        <div class="nav-item">
            <a href="/psychologue/rendezvous">
                <i data-lucide="calendar"></i>
                Mes rendez-vous
            </a>
        </div>
        <div class="nav-item">
            <a href="/assistance/messages">
                <i data-lucide="mail"></i>
                Messages
            </a>
        </div>

        <div class="nav-section">Plateforme</div>
        <div class="nav-item">
            <a href="/sensibilisation">
                <i data-lucide="book-open"></i>
                Sensibilisation
            </a>
        </div>
        <div class="nav-item">
            <a href="/prevention">
                <i data-lucide="shield"></i>
                Prévention
            </a>
        </div>
        <div class="nav-item">
            <a href="/assistant">
                <i data-lucide="bot"></i>
                Assistant IA
            </a>
        </div>
    </nav>

    <div class="sidebar-footer">
        <a href="/profil">
            <i data-lucide="user"></i>
            Mon profil
        </a>
        <form method="POST" action="/logout" style="margin:0;">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;width:100%;text-align:left;padding:10px 0;color:var(--forest);font-size:.9rem;display:flex;align-items:center;gap:12px;">
                <i data-lucide="log-out"></i>
                Déconnexion
            </button>
        </form>
    </div>
</div>

<div class="main">
    <div class="content">
        @if(session('success'))
            <div style="background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:24px;font-size:.88rem;">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="welcome-banner">
            <div>
                <h2 style="font-family:'Fraunces',serif;font-size:1.7rem;font-weight:300;color:white;margin:0 0 8px;">
                    Bonjour, Dr. {{ Auth::user()->name }} 👋
                </h2>
                <p style="color:rgba(255,255,255,.8);">Bienvenue dans votre espace de suivi psychologique</p>
            </div>
        </div>

        <div class="stat-cards">
            <div class="stat-card">
                <div class="num">{{ $rdvEnAttente ?? 0 }}</div>
                <div class="lbl">📅 RDV en attente</div>
            </div>
            <div class="stat-card" style="border-left-color:#3b82f6;">
                <div class="num" style="color:#3b82f6;">{{ $rdvConfirmes->count() ?? 0 }}</div>
                <div class="lbl">✅ RDV confirmés</div>
            </div>
            <div class="stat-card" style="border-left-color:#a855f7;">
                <div class="num" style="color:#a855f7;">{{ $notifications->count() ?? 0 }}</div>
                <div class="lbl">🔔 Notifications</div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="card-section">
                <div class="card-section-header">
                    <h2>📋 Prochains rendez-vous</h2>
                    <a href="/psychologue/rendezvous" style="font-size:.8rem;color:var(--sage);font-weight:600;text-decoration:none;">Voir tout →</a>
                </div>
                <div class="card-section-body">
                    @forelse($rdvConfirmes as $rdv)
                    <div class="rdv-item">
                        <div>
                            <p style="font-weight:600;font-size:.88rem;color:var(--dark);margin:0;">{{ $rdv->patient->name }}</p>
                            <p style="font-size:.78rem;color:var(--muted);margin:4px 0 0;">{{ $rdv->date_heure->format('d/m/Y à H:i') }}</p>
                        </div>
                        <span class="badge-statut badge-confirme">Confirmé</span>
                    </div>
                    @empty
                    <p style="color:var(--muted);font-size:.85rem;text-align:center;padding:20px 0;">Aucun rendez-vous confirmé</p>
                    @endforelse
                </div>
            </div>

            <div class="card-section">
                <div class="card-section-header">
                    <h2>🔔 Notifications</h2>
                </div>
                <div class="card-section-body">
                    @forelse($notifications as $notif)
                    <div class="notif-item">
                        <div class="notif-dot"></div>
                        <div>
                            <p style="font-weight:600;font-size:.85rem;color:var(--dark);margin:0;">{{ $notif->titre }}</p>
                            <p style="font-size:.78rem;color:var(--muted);margin:3px 0 0;">{{ $notif->message }}</p>
                        </div>
                    </div>
                    @empty
                    <p style="color:var(--muted);font-size:.85rem;text-align:center;padding:20px 0;">Aucune notification</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
lucide.createIcons();

const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
const hamburgerBtn = document.getElementById('hamburgerBtn');

function openSidebar() {
    sidebar.classList.add('open');
    overlay.classList.add('show');
    document.body.classList.add('menu-open');
}

function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
    document.body.classList.remove('menu-open');
}

function toggleSidebar() {
    if (sidebar.classList.contains('open')) {
        closeSidebar();
    } else {
        openSidebar();
    }
}

if (hamburgerBtn) hamburgerBtn.addEventListener('click', toggleSidebar);
if (overlay) overlay.addEventListener('click', closeSidebar);

document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 991) closeSidebar();
    });
});

window.addEventListener('resize', () => {
    if (window.innerWidth > 991) {
        closeSidebar();
    }
});
</script>
</body>
</html>
