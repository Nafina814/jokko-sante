<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestion Utilisateurs — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root { 
    --forest:#1A3D16; 
    --sage:#2D5A27; 
    --light:#E8F5E4; 
    --dark:#0f2410; 
    --muted:#6b7568; 
}
* { box-sizing:border-box; margin:0; padding:0; }
body { font-family:'DM Sans',sans-serif; background:#F5F9F4; }

/* SIDEBAR */
.sidebar { 
    position:fixed; top:0; left:0; width:260px; height:100vh; 
    background:var(--forest); display:flex; flex-direction:column; 
    z-index:1050; transition:transform 0.3s ease;
}
.sidebar-brand { padding:28px 24px; border-bottom:1px solid rgba(255,255,255,.08); }
.sidebar-brand a { font-family:'Fraunces',serif; font-size:1.4rem; font-weight:600; color:white; text-decoration:none; }
.sidebar-brand a span { color:var(--light); }
.sidebar-brand p { color:rgba(255,255,255,.4); font-size:.75rem; margin-top:4px; }
.sidebar-nav { padding:20px 0; flex:1; }
.nav-section { padding:8px 24px; font-size:.7rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; color:rgba(255,255,255,.3); margin-top:12px; }
.nav-item a { display:flex; align-items:center; gap:12px; padding:11px 24px; color:rgba(255,255,255,.65); text-decoration:none; font-size:.88rem; font-weight:500; transition:all .25s; }
.nav-item a:hover { background:rgba(255,255,255,.07); color:white; }
.nav-item a.active { background:rgba(255,255,255,.1); color:white; border-right:3px solid var(--light); }

/* MAIN + HAMBURGER */
.main { margin-left:260px; min-height:100vh; transition:margin-left 0.3s ease; }
.topbar { 
    background:white; padding:16px 20px; border-bottom:1px solid rgba(0,0,0,.07); 
    display:flex; align-items:center; justify-content:space-between; 
    position:sticky; top:0; z-index:1040; 
}
.hamburger { background:none; border:none; font-size:1.8rem; color:var(--dark); cursor:pointer; padding:8px; display:none; }
.topbar h1 { font-family:'Fraunces',serif; font-size:1.3rem; font-weight:600; color:var(--dark); margin:0; }
.topbar-right { display:flex; align-items:center; gap:12px; }
.avatar { width:36px; height:36px; border-radius:50%; background:var(--forest); display:flex; align-items:center; justify-content:center; color:white; font-size:.82rem; font-weight:700; }

/* RESPONSIVE */
@media (max-width: 992px) {
    .hamburger { display:block; }
    .sidebar { transform:translateX(-100%); }
    .sidebar.active { transform:translateX(0); }
    .main { margin-left:0; }
}

/* STAT CARDS - Style comme votre exemple */
.stat-cards { 
    display:grid; 
    grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); 
    gap:20px; 
    margin-bottom:32px; 
}
.stat-card { 
    background:white; 
    border-radius:16px; 
    padding:28px 24px; 
    border:1px solid rgba(0,0,0,.06); 
    box-shadow:0 6px 20px rgba(0,0,0,.04);
    transition: all 0.3s ease;
}
.stat-card:hover { 
    transform: translateY(-6px); 
}
.stat-card .num { 
    font-family:'Fraunces',serif; 
    font-size:2.6rem; 
    font-weight:600; 
    line-height:1; 
    margin-bottom:10px;
}
.stat-card .lbl { 
    font-size:0.95rem; 
    color:#555; 
    font-weight:500;
}

/* Bordures colorées à gauche */
.stat-total   { border-left:6px solid #1A3D16; }
.stat-psycho  { border-left:6px solid #1e40af; }
.stat-pair    { border-left:6px solid #6b21a8; }
.stat-inactif { border-left:6px solid #dc2626; }

/* Table */
.table-card { background:white; border-radius:20px; border:1px solid rgba(0,0,0,.06); overflow:hidden; }
.table-header { padding:20px 24px; border-bottom:1px solid rgba(0,0,0,.06); display:flex; flex-wrap:wrap; gap:12px; justify-content:space-between; align-items:center; }
.table-container { overflow-x:auto; -webkit-overflow-scrolling:touch; }
table { width:100%; min-width:900px; border-collapse:collapse; }
thead th { padding:12px 16px; font-size:.73rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase; color:var(--muted); background:#fafaf8; white-space:nowrap; }
tbody td { padding:14px 16px; font-size:.85rem; vertical-align:middle; }
tbody tr:hover { background:#fafaf8; }

.alert-success { background:#f0faf0; border:1px solid #86efac; color:#166534; border-radius:12px; padding:12px 18px; margin-bottom:24px; font-size:.88rem; }
.alert-error   { background:#fef2f2; border:1px solid #fca5a5; color:#dc2626; border-radius:12px; padding:12px 18px; margin-bottom:24px; font-size:.88rem; }

.badge-role { padding:5px 12px; border-radius:50px; font-size:.72rem; font-weight:700; }
.badge-admin { background:#fef3c7; color:#92400e; }
.badge-psychologue { background:#dbeafe; color:#1e40af; }
.badge-utilisateur { background:var(--light); color:var(--forest); }
.badge-pair { background:#f3e8ff; color:#6b21a8; }
.badge-actif { background:#dcfce7; color:#166534; padding:5px 10px; border-radius:50px; }
.badge-inactif { background:#fee2e2; color:#dc2626; padding:5px 10px; border-radius:50px; }

.btn-toggle, .btn-delete, .btn-save { border:none; border-radius:8px; padding:7px 12px; font-size:.8rem; font-weight:600; cursor:pointer; }
.btn-toggle-off { background:#dcfce7; color:#166534; }
.btn-toggle-on  { background:#fee2e2; color:#dc2626; }
.btn-delete { background:#fee2e2; color:#dc2626; }
.select-role { border:1.5px solid #e0e8dc; border-radius:8px; padding:6px 8px; font-size:.8rem; }
.search-input { width:100%; max-width:300px; padding:10px 14px; border:1.5px solid #e0e8dc; border-radius:10px; }
.user-avatar { width:34px; height:34px; border-radius:50%; background:var(--forest); display:inline-flex; align-items:center; justify-content:center; color:white; font-size:.78rem; font-weight:700; margin-right:10px; }
.user-info { display:flex; align-items:center; }
.user-name { font-weight:600; font-size:.88rem; }
.user-email { font-size:.78rem; color:var(--muted); display:block; }
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
            <button class="hamburger" id="hamburgerBtn"><i data-lucide="menu"></i></button>
            <h1>Gestion des utilisateurs</h1>
        </div>
        <div class="topbar-right">
            <span style="font-size:.84rem;color:var(--muted);">{{ Auth::user()->name }}</span>
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        </div>
    </div>

    <div class="content">
        @if(session('success'))<div class="alert-success">✅ {{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert-error">❌ {{ session('error') }}</div>@endif

        <!-- STATISTIQUES -->
        <div class="stat-cards">
            <div class="stat-card stat-total">
                <div class="num">{{ $users->count() }}</div>
                <div class="lbl">Total utilisateurs</div>
            </div>
            <div class="stat-card stat-psycho">
                <div class="num" style="color:#1e40af;">{{ $users->where('role_id', 2)->count() }}</div>
                <div class="lbl">Psychologues</div>
            </div>
            <div class="stat-card stat-pair">
                <div class="num" style="color:#6b21a8;">{{ $users->where('role_id', 4)->count() }}</div>
                <div class="lbl">Pair-aidants</div>
            </div>
            <div class="stat-card stat-inactif">
                <div class="num" style="color:#dc2626;">{{ $users->where('actif', false)->count() }}</div>
                <div class="lbl">Comptes inactifs</div>
            </div>
        </div>

        <!-- TABLEAU -->
        <div class="table-card">
            <div class="table-header">
                <h2>Liste des utilisateurs</h2>
                <input type="text" class="search-input" id="searchInput" placeholder="🔍 Rechercher...">
            </div>
            <div class="table-container">
                <table id="usersTable">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Genre</th>
                            <th>Rôle actuel</th>
                            <th>Statut</th>
                            <th>Inscrit le</th>
                            <th>Changer le rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                                    <div>
                                        <div class="user-name">{{ $user->name }}</div>
                                        <span class="user-email">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ ucfirst($user->genre ?? '—') }}</td>
                            <td>
                                @if($user->role->nom === 'admin')<span class="badge-role badge-admin">👑 Admin</span>
                                @elseif($user->role->nom === 'psychologue')<span class="badge-role badge-psychologue">🩺 Psychologue</span>
                                @elseif($user->role->nom === 'pair_aidant')<span class="badge-role badge-pair">🤝 Pair-aidant</span>
                                @else<span class="badge-role badge-utilisateur">🌿 Utilisateur</span>@endif
                            </td>
                            <td>
                                @if($user->actif)<span class="badge-actif">✅ Actif</span>
                                @else<span class="badge-inactif">❌ Inactif</span>@endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.role', $user) }}" style="display:flex;gap:6px;">
                                    @csrf
                                    <select name="role_id" class="select-role">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $role->nom)) }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn-save">✓</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.toggle', $user) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-toggle {{ $user->actif ? 'btn-toggle-on' : 'btn-toggle-off' }}">
                                        {{ $user->actif ? 'Désactiver' : 'Activer' }}
                                    </button>
                                </form>
                                @if($user->id !== Auth::id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete">🗑</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
    icon.setAttribute('data-lucide', sidebar.classList.contains('active') ? 'x' : 'menu');
    lucide.createIcons();
});

document.addEventListener('click', (e) => {
    if (window.innerWidth <= 992 && !sidebar.contains(e.target) && !hamburgerBtn.contains(e.target)) {
        sidebar.classList.remove('active');
        const icon = hamburgerBtn.querySelector('i');
        icon.setAttribute('data-lucide', 'menu');
        lucide.createIcons();
    }
});

document.getElementById('searchInput').addEventListener('input', function() {
    const val = this.value.toLowerCase();
    document.querySelectorAll('#usersTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(val) ? '' : 'none';
    });
});
</script>
</body>
</html>