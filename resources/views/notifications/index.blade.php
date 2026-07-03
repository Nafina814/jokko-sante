<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Notifications — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root {
  --forest:#1A3D16;
  --sage:#2D5A27;
  --mint:#3A6B2F;
  --light:#E8F5E4;
  --dark:#0f2410;
  --muted:#6b7568;
}

*,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'DM Sans',sans-serif; background:#F5F9F4; }
body.menu-open { overflow:hidden; }

/* ==================== MOBILE TOPBAR ==================== */
.mobile-topbar{
  display:none;
  position:fixed;
  top:0; left:0; right:0;
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
  width:44px; height:44px;
  border:none; border-radius:12px;
  background:#f0f9ed; color:var(--forest);
  display:flex; align-items:center; justify-content:center;
  cursor:pointer;
}
.hamburger-btn i{ width:22px; height:22px; }
.mobile-brand{
  text-decoration:none; display:flex; align-items:center;
  gap:8px; font-family:'Fraunces',serif;
  font-size:1.1rem; font-weight:600; color:var(--forest);
}
.mobile-brand span{ color:var(--mint); }
.mobile-brand i{ width:22px; height:22px; }

.sidebar-overlay{
  position:fixed; inset:0;
  background:rgba(15,36,16,.45);
  z-index:95; opacity:0; visibility:hidden;
  transition:all .3s ease;
}

/* ==================== SIDEBAR ==================== */
.sidebar {
  position:fixed; top:0; left:0;
  width:260px; height:100vh;
  background:white; border-right:1px solid #e5ede0;
  display:flex; flex-direction:column;
  z-index:100; box-shadow:2px 0 10px rgba(0,0,0,0.06);
}
.sidebar-brand { padding:28px 24px; border-bottom:1px solid #e5ede0; }
.sidebar-brand a {
  font-family:'Fraunces',serif; font-size:1.45rem; font-weight:600;
  color:var(--forest); text-decoration:none;
  display:flex; align-items:center; gap:8px;
}
.sidebar-brand a span { color:var(--mint); }
.sidebar-nav { padding:20px 0; flex:1; overflow-y:auto; }
.nav-section {
  padding:8px 24px 4px; font-size:.7rem; font-weight:700;
  letter-spacing:.1em; text-transform:uppercase;
  color:var(--sage); margin-top:12px;
}
.nav-item a {
  display:flex; align-items:center; gap:14px;
  padding:12px 24px; color:var(--forest); text-decoration:none;
  font-size:.92rem; font-weight:500; transition:all .25s;
  border-radius:0 8px 8px 0; margin:2px 8px;
  position:relative;
}
.nav-item a:hover, .nav-item a.active {
  background:#f0f9ed; color:var(--mint); font-weight:600;
}
.nav-item a i { width:20px; height:20px; color:var(--sage); }

.nav-badge{
  position:absolute; right:14px;
  background:#ef4444; color:white;
  font-size:.62rem; font-weight:700;
  padding:2px 7px; border-radius:999px;
  min-width:20px; text-align:center;
}
.nav-badge.blue{ background:#3b82f6; }

.sidebar-footer {
  margin-top:auto; padding:20px 24px; border-top:1px solid #e5ede0;
}
.sidebar-footer a {
  display:flex; align-items:center; gap:12px;
  color:var(--forest); text-decoration:none;
  padding:10px 0; font-size:.9rem;
}
.sidebar-footer a:hover { color:var(--mint); }

/* ==================== MAIN ==================== */
.main { margin-left:260px; min-height:100vh; }
.content { padding:32px; max-width:900px; }

.page-head{ margin-bottom:28px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
.page-head h1{
  font-family:'Fraunces',serif; font-size:1.9rem; font-weight:300; color:var(--dark);
}
.page-head p{ color:var(--muted); font-size:.9rem; margin-top:4px; }

/* Card section */
.card-section{
  background:white; border-radius:20px;
  border:1px solid rgba(0,0,0,.06);
  overflow:hidden;
}
.card-section-body{ padding:8px 24px; }

/* Notification item */
.notif-item{
  display:flex; align-items:flex-start; gap:14px;
  padding:18px 0; border-bottom:1px solid #f0f4ee;
}
.notif-item:last-child{ border-bottom:none; }
.notif-item.unread{ background:#f8fdf6; margin:0 -24px; padding:18px 24px; }
.notif-dot{
  width:10px; height:10px; border-radius:50%;
  background:var(--mint); margin-top:6px; flex-shrink:0;
}
.notif-dot.red{ background:#ef4444; }
.notif-dot.blue{ background:#3b82f6; }
.notif-body strong{ color:var(--dark); font-size:.95rem; }
.notif-body p{ margin-top:5px; color:#666; font-size:.87rem; line-height:1.6; }
.notif-body small{ color:#999; font-size:.76rem; }

.empty-state{ text-align:center; padding:70px 20px; }
.empty-state h3{ font-family:'Fraunces',serif; font-size:1.4rem; color:var(--dark); margin-bottom:10px; }
.empty-state p{ color:var(--muted); font-size:.9rem; }

.pagination-wrap{ margin-top:24px; display:flex; justify-content:center; }

/* Topbar badge (mobile) */
.topbar-notif{
  position:relative; display:inline-flex;
  align-items:center; justify-content:center;
  width:38px; height:38px; border-radius:10px;
  background:#f0f9ed; border:1px solid #e5ede0;
  cursor:pointer; text-decoration:none; color:var(--forest);
}
.topbar-notif i{ width:18px; height:18px; }
.topbar-dot{
  position:absolute; top:6px; right:6px;
  width:8px; height:8px; border-radius:50%;
  border:2px solid white;
}
.topbar-dot.red{ background:#ef4444; }

/* RESPONSIVE */
@media(max-width:991px){
  .mobile-topbar{ display:flex; }
  .sidebar{ transform:translateX(-100%); transition:transform .3s ease; width:280px; }
  .sidebar.open{ transform:translateX(0); }
  .sidebar-overlay.show{ opacity:1; visibility:visible; }
  .main{ margin-left:0; padding-top:72px; }
  .content{ padding:20px 16px 28px; }
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
    <div style="margin-left:auto;display:flex;align-items:center;gap:8px;">
        <span class="topbar-notif">
            <i data-lucide="bell"></i>
        </span>
    </div>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="/">
            <i data-lucide="leaf" style="width:28px;height:28px;"></i>
            Jokko<span style="color:var(--mint);">Santé</span>
        </a>
        <p style="color:var(--sage);font-size:0.8rem;margin-top:4px;">Espace Administrateur</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <div class="nav-item">
            <a href="/dashboard">
                <i data-lucide="layout-dashboard"></i>
                Tableau de bord
            </a>
        </div>

        <div class="nav-section">Gestion</div>
        <div class="nav-item">
            <a href="/admin/utilisateurs">
                <i data-lucide="users"></i>
                Utilisateurs
            </a>
        </div>
        <div class="nav-item">
            <a href="/admin/articles">
                <i data-lucide="file-text"></i>
                Articles
            </a>
        </div>
        <div class="nav-item">
            <a href="/admin/rendezvous">
                <i data-lucide="calendar"></i>
                Rendez-vous
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
            <a href="/assistance">
                <i data-lucide="message-circle"></i>
                Assistance
            </a>
        </div>
        <div class="nav-item">
            <a href="/admin/signalements">
                <i data-lucide="alert-triangle"></i>
                Signalements
            </a>
        </div>

        <div class="nav-section">Modération</div>
        <div class="nav-item">
            <a href="/admin/temoignages">
                <i data-lucide="shield-check"></i>
                Témoignages
            </a>
        </div>

        <div class="nav-section">Communication</div>
        <div class="nav-item">
            <a href="/assistance/messages">
                <i data-lucide="mail"></i>
                Messages
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('notifications.index') }}" class="active">
                <i data-lucide="bell"></i>
                Notifications
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
            <button type="submit" style="background:none;border:none;cursor:pointer;width:100%;text-align:left;padding:10px 0;color:var(--forest);font-size:.9rem;display:flex;align-items:center;gap:12px;font-family:'DM Sans',sans-serif;">
                <i data-lucide="log-out"></i>
                Déconnexion
            </button>
        </form>
    </div>
</div>

<div class="main">
    <div class="content">

        @if(session('success'))
        <div style="background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:24px;font-size:.88rem;display:flex;align-items:center;gap:8px;">
            <i data-lucide="check-circle" style="width:18px;height:18px;flex-shrink:0;"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="page-head">
            <div>
                <h1>Notifications</h1>
                <p>{{ $notifications->total() }} notification(s) au total</p>
            </div>
        </div>

        <div class="card-section">
            <div class="card-section-body">

                @forelse($notifications as $notification)

                    <div class="notif-item @if(!$notification->lu) unread @endif">

                        <div class="notif-dot
                            @if($notification->type=='alerte')
                                red
                            @elseif($notification->type=='message')
                                blue
                            @endif">
                        </div>

                        <div class="notif-body">

                            <strong>{{ $notification->titre }}</strong>

                            <p>{{ $notification->message }}</p>

                            <small>{{ $notification->created_at->diffForHumans() }}</small>

                        </div>

                    </div>

                @empty

                    <div class="empty-state">
                        <div style="font-size:3.5rem;margin-bottom:16px;">🔔</div>
                        <h3>Aucune notification</h3>
                        <p>Vous serez averti ici dès qu'il y aura du nouveau.</p>
                    </div>

                @endforelse

            </div>
        </div>

        @if($notifications->hasPages())
        <div class="pagination-wrap">
            {{ $notifications->links() }}
        </div>
        @endif

    </div>
</div>

<script>
lucide.createIcons();

const sidebar  = document.getElementById('sidebar');
const overlay  = document.getElementById('sidebarOverlay');
const hamburgerBtn = document.getElementById('hamburgerBtn');

function openSidebar()  { sidebar.classList.add('open');    overlay.classList.add('show');    document.body.classList.add('menu-open'); }
function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('show'); document.body.classList.remove('menu-open'); }
function toggleSidebar(){ sidebar.classList.contains('open') ? closeSidebar() : openSidebar(); }

if (hamburgerBtn) hamburgerBtn.addEventListener('click', toggleSidebar);
if (overlay)      overlay.addEventListener('click', closeSidebar);

document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', () => { if (window.innerWidth <= 991) closeSidebar(); });
});
window.addEventListener('resize', () => { if (window.innerWidth > 991) closeSidebar(); });
</script>
</body>
</html>