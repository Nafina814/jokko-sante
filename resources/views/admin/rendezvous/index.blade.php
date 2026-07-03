<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestion Rendez-vous — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--mint:#3A6B2F;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F5F9F4;}

.sidebar{position:fixed;top:0;left:0;width:260px;height:100vh;background:var(--forest);display:flex;flex-direction:column;z-index:1050;transition:transform 0.3s ease;}
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

.main{margin-left:260px;min-height:100vh;transition:margin-left 0.3s ease;}
.topbar{background:white;padding:16px 32px;border-bottom:1px solid rgba(0,0,0,.07);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:1040;}
.hamburger{background:none;border:none;font-size:1.8rem;color:var(--dark);cursor:pointer;padding:8px;display:none;}
.topbar h1{font-family:'Fraunces',serif;font-size:1.3rem;font-weight:600;color:var(--dark);margin:0;}
.avatar{width:38px;height:38px;border-radius:50%;background:var(--forest);display:flex;align-items:center;justify-content:center;color:white;font-size:.82rem;font-weight:700;}
.content{padding:32px;}

/* RESPONSIVE */
@media (max-width: 992px) {
    .hamburger{display:block;}
    .sidebar{transform:translateX(-100%);}
    .sidebar.active{transform:translateX(0);}
    .main{margin-left:0;}
}

/* Styles existants */
.stat-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:32px;}
.stat-card{background:white;border-radius:16px;padding:22px 24px;border:1px solid rgba(0,0,0,.06);border-left:4px solid var(--forest);transition:transform .3s;}
.stat-card:hover{transform:translateY(-4px);}
.stat-card .num{font-family:'Fraunces',serif;font-size:2.2rem;font-weight:600;color:var(--forest);line-height:1;}
.stat-card .lbl{font-size:.8rem;color:var(--muted);margin-top:8px;}

.tabs{display:flex;gap:4px;background:white;border-radius:14px;padding:6px;border:1px solid rgba(0,0,0,.07);margin-bottom:24px;width:fit-content;}
.tab-btn{border:none;background:transparent;border-radius:10px;padding:9px 20px;font-size:.84rem;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;color:var(--muted);transition:all .25s;}
.tab-btn.active{background:var(--forest);color:white;}
.tab-btn:hover:not(.active){background:#f0f0f0;}

.table-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.06);overflow:hidden;}
.table-header{padding:20px 24px;border-bottom:1px solid rgba(0,0,0,.06);display:flex;align-items:center;justify-content:space-between;}
.table-header h2{font-family:'Fraunces',serif;font-size:1.05rem;color:var(--dark);margin:0;font-weight:600;}
.search-input{border:1.5px solid #e0e8dc;border-radius:10px;padding:8px 14px;font-size:.84rem;font-family:'DM Sans',sans-serif;outline:none;width:220px;transition:border-color .25s;}
.search-input:focus{border-color:var(--sage);}
table{width:100%;border-collapse:collapse;}
thead th{padding:12px 20px;font-size:.75rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);background:#fafaf8;border-bottom:1px solid rgba(0,0,0,.06);text-align:left;}
tbody tr{border-bottom:1px solid rgba(0,0,0,.05);transition:background .2s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:#fafaf8;}
tbody td{padding:14px 20px;font-size:.87rem;color:var(--dark);vertical-align:middle;}

.user-avatar{width:32px;height:32px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;color:white;font-size:.72rem;font-weight:700;margin-right:8px;vertical-align:middle;flex-shrink:0;}
.avatar-patient{background:var(--forest);}
.avatar-psycho{background:#3b82f6;}

.badge-s{padding:5px 12px;border-radius:50px;font-size:.74rem;font-weight:700;}
.s-en_attente{background:#fef3c7;color:#92400e;}
.s-confirme{background:#dcfce7;color:#166534;}
.s-termine{background:#f1f5f9;color:#64748b;}
.s-annule{background:#fee2e2;color:#dc2626;}

.btn-del{background:#fee2e2;color:#dc2626;border:none;border-radius:8px;padding:6px 10px;font-size:.78rem;font-weight:600;cursor:pointer;transition:all .25s;}
.btn-del:hover{background:#fecaca;}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:24px;font-size:.88rem;}
.empty{text-align:center;padding:40px;color:var(--muted);font-size:.88rem;}
.tab-content{display:none;}
.tab-content.active{display:block;}

/* AJOUT MOBILE (sans toucher au CSS original) */
@media (max-width: 768px) {
    .stat-cards { grid-template-columns: repeat(2, 1fr); }
    .table-container { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    table { min-width: 800px; }
    .tabs { flex-wrap: wrap; width: 100%; }
    .tab-btn { flex: 1; text-align: center; }
    .content { padding: 20px 16px; }
}
</style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="/">🌿 Jokko<span>Santé</span></a>
        <p>Espace Administrateur</p>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <div class="nav-item"><a href="/dashboard"><span class="icon">📊</span> Tableau de bord</a></div>
    </nav>
</div>

<div class="main">
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:16px;">
            <button class="hamburger" id="hamburgerBtn">
                <i data-lucide="menu"></i>
            </button>
            <h1>Gestion des rendez-vous</h1>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:.84rem;color:var(--muted);">{{ Auth::user()->name }}</span>
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        </div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        <div class="stat-cards">
            <div class="stat-card">
                <div class="num">{{ $totalRdv }}</div>
                <div class="lbl">📅 Total rendez-vous</div>
            </div>
            <div class="stat-card" style="border-left-color:#ca8a04;">
                <div class="num" style="color:#ca8a04;">{{ $totalAttente }}</div>
                <div class="lbl">⏳ En attente</div>
            </div>
            <div class="stat-card" style="border-left-color:#16a34a;">
                <div class="num" style="color:#16a34a;">{{ $totalConfirme }}</div>
                <div class="lbl">✅ Confirmés</div>
            </div>
            <div class="stat-card" style="border-left-color:#64748b;">
                <div class="num" style="color:#64748b;">{{ $totalTermine }}</div>
                <div class="lbl">🏁 Terminés</div>
            </div>
        </div>

        <div class="tabs">
            <button class="tab-btn active" onclick="switchTab('attente', this)">⏳ En attente ({{ $totalAttente }})</button>
            <button class="tab-btn" onclick="switchTab('confirmes', this)">✅ Confirmés ({{ $totalConfirme }})</button>
            <button class="tab-btn" onclick="switchTab('historique', this)">🏁 Historique</button>
        </div>

        <!-- TAB EN ATTENTE -->
        <div class="tab-content active" id="tab-attente">
            <div class="table-card">
                <div class="table-header">
                    <h2>⏳ Rendez-vous en attente</h2>
                    <input type="text" class="search-input" placeholder="🔍 Rechercher..." oninput="filterTable(this, 'table-attente')">
                </div>
                <div class="table-container">
                    <table id="table-attente">
                        <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Psychologue</th>
                                <th>Date & Heure</th>
                                <th>Motif</th>
                                <th>Demandé le</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rdvEnAttente as $rdv)
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;">
                                        <div class="user-avatar avatar-patient">{{ strtoupper(substr($rdv->patient->name, 0, 2)) }}</div>
                                        <div>
                                            <p style="font-weight:600;margin:0;font-size:.86rem;">{{ $rdv->patient->name }}</p>
                                            <p style="font-size:.75rem;color:var(--muted);margin:0;">{{ $rdv->patient->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex;align-items:center;">
                                        <div class="user-avatar avatar-psycho">{{ strtoupper(substr($rdv->psychologue->name, 0, 2)) }}</div>
                                        <span style="font-size:.86rem;">Dr. {{ $rdv->psychologue->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <p style="font-weight:600;margin:0;font-size:.86rem;">{{ $rdv->date_heure->format('d/m/Y') }}</p>
                                    <p style="font-size:.78rem;color:var(--muted);margin:2px 0 0;">{{ $rdv->date_heure->format('H:i') }}</p>
                                </td>
                                <td style="color:var(--muted);font-size:.82rem;max-width:180px;">{{ $rdv->motif ? Str::limit($rdv->motif, 50) : '—' }}</td>
                                <td style="color:var(--muted);font-size:.82rem;">{{ $rdv->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.rendezvous.destroy', $rdv) }}" onsubmit="return confirm('Supprimer ce rendez-vous ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-del">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="empty">Aucun rendez-vous en attente</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB CONFIRMES -->
        <div class="tab-content" id="tab-confirmes">
            <div class="table-card">
                <div class="table-header">
                    <h2>✅ Rendez-vous confirmés</h2>
                    <input type="text" class="search-input" placeholder="🔍 Rechercher..." oninput="filterTable(this, 'table-confirmes')">
                </div>
                <div class="table-container">
                    <table id="table-confirmes">
                        <!-- Même structure que ci-dessus pour les autres tabs -->
                        <!-- ... (le reste de votre code des tabs confirmes et historique reste identique) ... -->
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB HISTORIQUE -->
        <div class="tab-content" id="tab-historique">
            <div class="table-card">
                <div class="table-header">
                    <h2>🏁 Historique des rendez-vous</h2>
                    <input type="text" class="search-input" placeholder="🔍 Rechercher..." oninput="filterTable(this, 'table-historique')">
                </div>
                <div class="table-container">
                    <table id="table-historique">
                        <!-- Votre contenu original -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
lucide.createIcons();

const hamburgerBtn = document.getElementById('hamburgerBtn');
const sidebar = document.getElementById('sidebar');

hamburgerBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    const icon = hamburgerBtn.querySelector('i');
    if (sidebar.classList.contains('active')) {
        icon.setAttribute('data-lucide', 'x');
    } else {
        icon.setAttribute('data-lucide', 'menu');
    }
    lucide.createIcons();
});

document.addEventListener('click', (e) => {
    if (window.innerWidth <= 992 && 
        !sidebar.contains(e.target) && 
        !hamburgerBtn.contains(e.target)) {
        sidebar.classList.remove('active');
        const icon = hamburgerBtn.querySelector('i');
        icon.setAttribute('data-lucide', 'menu');
        lucide.createIcons();
    }
});

function switchTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}

function filterTable(input, tableId) {
    const val = input.value.toLowerCase();
    document.querySelectorAll('#' + tableId + ' tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
    });
}
</script>
</body>
</html>