<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard Admin — Jokko Santé</title>
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

/* Badge nav */
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
.content { padding:32px; }

/* STAT CARDS */
.stat-cards { 
  display:grid; grid-template-columns:repeat(4,1fr);
  gap:16px; margin-bottom:32px;
}
.stat-card { 
  background:white; border-radius:16px; padding:22px 24px;
  border:1px solid rgba(0,0,0,.06); border-left:4px solid var(--forest);
  transition:transform .3s;
}
.stat-card:hover { transform:translateY(-4px); }
.stat-card .num { 
  font-family:'Fraunces',serif; font-size:2.2rem;
  font-weight:600; color:var(--forest);
}
.stat-card .lbl { font-size:.82rem; color:var(--muted); margin-top:8px; }

/* ACTION GRID */
.action-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.action-card { 
  background:white; border-radius:20px; padding:28px;
  border:1px solid rgba(0,0,0,.06); text-decoration:none;
  display:flex; align-items:center; gap:18px; transition:all .3s;
}
.action-card:hover { transform:translateY(-6px); box-shadow:0 20px 48px rgba(26,61,22,.12); }
.action-icon{
  width:58px; height:58px; border-radius:16px;
  display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.action-card h3{ color:var(--dark); margin:0 0 6px; font-size:1rem; }
.action-card p{ color:var(--muted); margin:0; font-size:.88rem; }

/* WELCOME BANNER */
.welcome-banner { 
  background:var(--forest); border-radius:20px;
  padding:32px 36px; margin-bottom:32px;
  display:flex; align-items:center; justify-content:space-between;
}

/* Card section générique */
.card-section{
  background:white; border-radius:20px;
  border:1px solid rgba(0,0,0,.06);
  overflow:hidden; margin-bottom:20px;
}
.card-section-header{
  padding:18px 24px; border-bottom:1px solid rgba(0,0,0,.06);
  display:flex; align-items:center; justify-content:space-between;
}
.card-section-header h2{
  font-family:'Fraunces',serif; font-size:1.05rem;
  font-weight:600; color:var(--dark); margin:0;
  display:flex; align-items:center; gap:10px;
}
.card-section-body{ padding:20px 24px; }
.card-link{
  font-size:.8rem; color:var(--sage); font-weight:600;
  text-decoration:none; display:flex; align-items:center; gap:4px;
  transition:color .2s;
}
.card-link:hover{ color:var(--forest); }
.card-link i{ width:14px; height:14px; }

/* Badge nombre */
.count-badge{
  display:inline-flex; align-items:center; justify-content:center;
  background:#3b82f6; color:white;
  font-size:.65rem; font-weight:700;
  padding:2px 8px; border-radius:999px;
  min-width:22px;
}
.count-badge.red{ background:#ef4444; }
.count-badge.green{ background:#16a34a; }

/* Message item */
.msg-item{
  display:flex; align-items:flex-start; gap:14px;
  padding:14px 0; border-bottom:1px solid #f0f4ee;
  transition:background .2s;
}
.msg-item:last-child{ border-bottom:none; }
.msg-item.unread{ 
  background:#f0f9ff; border-radius:12px;
  padding:14px; margin-bottom:4px;
  border-bottom:none;
}
.msg-avatar{
  width:40px; height:40px; border-radius:50%; flex-shrink:0;
  background:var(--forest); display:flex; align-items:center;
  justify-content:center; color:white;
  font-size:.78rem; font-weight:700;
}
.msg-avatar.blue{ background:linear-gradient(135deg,#3b82f6,#2563eb); }
.msg-avatar.purple{ background:linear-gradient(135deg,#a855f7,#7c3aed); }
.msg-body{ flex:1; min-width:0; }
.msg-sender{ 
  font-size:.86rem; font-weight:600; color:var(--dark);
  display:flex; align-items:center; gap:6px; flex-wrap:wrap;
  margin-bottom:4px;
}
.msg-preview{ font-size:.8rem; color:var(--muted); line-height:1.5; }
.msg-time{ font-size:.72rem; color:var(--muted); white-space:nowrap; margin-left:auto; }

/* Badge rôle */
.role-pill{
  display:inline-flex; align-items:center; gap:3px;
  font-size:.65rem; font-weight:700;
  padding:2px 7px; border-radius:999px;
}
.role-pill.user{ background:#dcfce7; color:#166534; }
.role-pill.psycho{ background:#dbeafe; color:#1e40af; }
.role-pill.pair{ background:#ede9fe; color:#6d28d9; }

/* Badge nouveau */
.badge-new{
  background:#3b82f6; color:white;
  font-size:.62rem; font-weight:700;
  padding:1px 7px; border-radius:999px;
}

/* Bouton répondre inline */
.btn-reply-inline{
  display:inline-flex; align-items:center; gap:5px;
  background:#f0f9ed; color:var(--forest);
  border:1px solid #c8e6c0; border-radius:7px;
  padding:5px 12px; font-size:.74rem; font-weight:600;
  cursor:pointer; font-family:'DM Sans',sans-serif;
  text-decoration:none; transition:all .2s;
  margin-top:8px;
}
.btn-reply-inline:hover{ background:var(--light); border-color:var(--sage); }
.btn-reply-inline i{ width:13px; height:13px; }

/* Formulaire réponse rapide */
.quick-reply{
  display:none; margin-top:10px;
  background:#f8fdf6; border-radius:10px;
  border:1px solid #dce8d8; padding:12px;
}
.quick-reply.show{ display:block; animation:slideDown .2s ease; }
@keyframes slideDown{ from{opacity:0;transform:translateY(-6px)} to{opacity:1;transform:translateY(0)} }
.quick-reply textarea{
  width:100%; padding:9px 12px;
  border:1.5px solid #dce8d8; border-radius:8px;
  font-family:'DM Sans',sans-serif; font-size:.84rem;
  color:var(--dark); background:white; outline:none;
  resize:vertical; min-height:72px;
  transition:border-color .2s;
}
.quick-reply textarea:focus{ border-color:var(--sage); box-shadow:0 0 0 3px rgba(45,90,39,.08); }
.quick-reply-footer{
  display:flex; align-items:center;
  justify-content:flex-end; gap:8px; margin-top:8px;
}
.btn-cancel-reply{
  background:none; border:1px solid #dce8d8; border-radius:7px;
  padding:6px 14px; font-size:.78rem; font-weight:600;
  color:var(--muted); cursor:pointer; font-family:'DM Sans',sans-serif;
}
.btn-send-reply{
  background:var(--forest); color:white; border:none;
  border-radius:7px; padding:7px 16px; font-size:.78rem; font-weight:700;
  cursor:pointer; font-family:'DM Sans',sans-serif;
  display:inline-flex; align-items:center; gap:6px; transition:all .2s;
}
.btn-send-reply:hover{ background:var(--sage); }
.btn-send-reply i{ width:13px; height:13px; }

/* Notification item */
.notif-item{
  display:flex; align-items:flex-start; gap:12px;
  padding:12px 0; border-bottom:1px solid #f0f4ee;
}
.notif-item:last-child{ border-bottom:none; }
.notif-dot{
  width:8px; height:8px; border-radius:50%;
  background:var(--mint); margin-top:6px; flex-shrink:0;
}
.notif-dot.red{ background:#ef4444; }
.notif-dot.blue{ background:#3b82f6; }

/* Topbar badge */
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
.topbar-dot.blue{ background:#3b82f6; }

/* RESPONSIVE */
@media(max-width:1200px){
  .stat-cards{ grid-template-columns:repeat(2,1fr); }
  .action-grid{ grid-template-columns:1fr; }
}
@media(max-width:991px){
  .mobile-topbar{ display:flex; }
  .sidebar{ transform:translateX(-100%); transition:transform .3s ease; width:280px; }
  .sidebar.open{ transform:translateX(0); }
  .sidebar-overlay.show{ opacity:1; visibility:visible; }
  .main{ margin-left:0; padding-top:72px; }
  .content{ padding:20px 16px 28px; }
  .welcome-banner{ padding:24px 20px; flex-direction:column; align-items:flex-start; gap:12px; }
  .stat-cards,.action-grid{ grid-template-columns:1fr; }
}
@media(max-width:576px){
  .stat-card .num{ font-size:1.8rem; }
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
        <a href="{{ route('notifications.index') }}" class="topbar-notif">
            <i data-lucide="bell"></i>

            @if(isset($notifications) && $notifications->where('lu', false)->count() > 0)
                <span class="topbar-dot red"></span>
            @endif
        </a>
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
            <a href="/dashboard" class="active">
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

        <!-- MODÉRATION TÉMOIGNAGES -->
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
                @if(isset($messagesNonLus) && $messagesNonLus > 0)
                    <span class="nav-badge blue">{{ $messagesNonLus }}</span>
                @endif
            </a>
        </div>
        <div class="nav-item">
        <a href="{{ route('notifications.index') }}">
                <i data-lucide="bell"></i>
                Notifications
                @php
                    $nonLues = $notifications->where('lu', false)->count();
                @endphp

                @if($nonLues > 0)
                    <span class="nav-badge">{{ $nonLues }}</span>
                @endif
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

        @if(session('error'))
        <div style="background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:12px 18px;margin-bottom:24px;font-size:.88rem;display:flex;align-items:center;gap:8px;">
            <i data-lucide="alert-circle" style="width:18px;height:18px;flex-shrink:0;"></i>
            {{ session('error') }}
        </div>
        @endif

        {{-- WELCOME BANNER --}}
        <div class="welcome-banner">
            <div>
                <h2 style="font-family:'Fraunces',serif;font-size:1.7rem;font-weight:300;color:white;margin:0 0 8px;">
                    Bonjour, {{ Auth::user()->name }} 👋
                </h2>
                <p style="color:rgba(255,255,255,.8);">Bienvenue dans votre espace d'administration Jokko Santé</p>
            </div>
            <div style="display:flex;align-items:center;gap:10px;">
                <a href="/assistance/messages" class="topbar-notif">
                    <i data-lucide="mail"></i>
                    @if(isset($messagesNonLus) && $messagesNonLus > 0)
                        <span class="topbar-dot blue"></span>
                    @endif
                </a>
                <a href="{{ route('notifications.index') }}" class="topbar-notif">
                    <i data-lucide="bell"></i>

                    @if(isset($notifications) && $notifications->where('lu', false)->count() > 0)
                        <span class="topbar-dot red"></span>
                    @endif
                </a>
            </div>
        </div>

        {{-- STAT CARDS --}}
        <div class="stat-cards">
            <div class="stat-card">
                <div class="num">{{ $totalUsers ?? 0 }}</div>
                <div class="lbl">Utilisateurs inscrits</div>
            </div>
            <div class="stat-card" style="border-left-color:#3b82f6;">
                <div class="num" style="color:#3b82f6;">{{ $totalArticles ?? 0 }}</div>
                <div class="lbl">Articles publiés</div>
            </div>
            <div class="stat-card" style="border-left-color:#a855f7;">
                <div class="num" style="color:#a855f7;">{{ $totalRdv ?? 0 }}</div>
                <div class="lbl">Rendez-vous</div>
            </div>
            <div class="stat-card" style="border-left-color:#f59e0b;">
                <div class="num" style="color:#f59e0b;">{{ $totalForums ?? 0 }}</div>
                <div class="lbl">Discussions forum</div>
            </div>
        </div>

        {{-- ACTIONS RAPIDES --}}
        <p style="font-size:.78rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;">Actions rapides</p>
        <div class="action-grid">
            <a href="/admin/utilisateurs" class="action-card">
                <div class="action-icon" style="background:var(--light);">
                    <i data-lucide="users" style="width:28px;height:28px;"></i>
                </div>
                <div>
                    <h3>Gérer les utilisateurs</h3>
                    <p>Rôles, activation, suivi</p>
                </div>
            </a>
            <a href="/admin/articles" class="action-card">
                <div class="action-icon" style="background:#dbeafe;">
                    <i data-lucide="file-text" style="width:28px;height:28px;"></i>
                </div>
                <div>
                    <h3>Gérer les articles</h3>
                    <p>Publier, modifier, supprimer</p>
                </div>
            </a>
            <a href="/admin/rendezvous" class="action-card">
                <div class="action-icon" style="background:#fef3c7;">
                    <i data-lucide="calendar" style="width:28px;height:28px;"></i>
                </div>
                <div>
                    <h3>Gérer les RDV</h3>
                    <p>Suivre les consultations</p>
                </div>
            </a>
        </div>

        {{-- APERÇU DES NOTIFICATIONS --}}
        <div class="card-section" style="margin-top:30px;">

            <div class="card-section-header">

                <h2>
                    <i data-lucide="bell"></i>
                    Notifications récentes
                </h2>

                <a href="{{ route('notifications.index') }}" class="card-link">
                    Voir tout
                    <i data-lucide="arrow-right"></i>
                </a>

            </div>

            <div class="card-section-body">

                @forelse($notifications as $notification)

                    <div class="notif-item">

                        <div class="notif-dot
                            @if($notification->type=='alerte')
                                red
                            @elseif($notification->type=='message')
                                blue
                            @endif">
                        </div>

                        <div>

                            <strong>{{ $notification->titre }}</strong>

                            <p style="margin-top:5px;color:#666;">
                                {{ $notification->message }}
                            </p>

                            <small style="color:#999;">
                                {{ $notification->created_at->diffForHumans() }}
                            </small>

                        </div>

                    </div>

                @empty

                    <p>Aucune notification.</p>

                @endforelse

            </div>

        </div>

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