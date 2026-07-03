<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestion Articles — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{
    --forest:#1A3D16;
    --sage:#2D5A27;
    --mint:#3A6B2F;
    --light:#E8F5E4;
    --dark:#0f2410;
    --muted:#6b7568;
}
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    font-family:'DM Sans',sans-serif;
    background:#F5F9F4;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    width:270px;
    height:100vh;
    background:linear-gradient(180deg,#173913,#102810);
    display:flex;
    flex-direction:column;
    z-index:1050;
    transition:transform 0.3s ease;
}
.sidebar-brand{
    padding:28px 24px;
    border-bottom:1px solid rgba(255,255,255,.08);
}
.brand-logo{
    display:flex;
    align-items:center;
    gap:12px;
    text-decoration:none;
    color:white;
    font-family:'Fraunces',serif;
    font-size:1.4rem;
    font-weight:600;
}
.brand-logo span{
    color:var(--light);
}
.sidebar-brand p{
    color:rgba(255,255,255,.45);
    font-size:.78rem;
    margin-top:8px;
}
.sidebar-nav{
    flex:1;
    padding:20px 0;
}
.nav-section{
    padding:8px 24px;
    font-size:.7rem;
    text-transform:uppercase;
    letter-spacing:.12em;
    color:rgba(255,255,255,.35);
    font-weight:700;
}
.nav-item a{
    display:flex;
    align-items:center;
    gap:12px;
    padding:13px 24px;
    text-decoration:none;
    color:rgba(255,255,255,.72);
    transition:.3s;
}
.nav-item a:hover{
    background:rgba(255,255,255,.06);
    color:white;
}
.nav-item a.active{
    background:rgba(255,255,255,.08);
    color:white;
    border-right:3px solid var(--light);
}

/* MAIN */
.main{
    margin-left:270px;
    min-height:100vh;
    transition:margin-left 0.3s ease;
}
.topbar{
    background:white;
    padding:16px 20px;
    border-bottom:1px solid rgba(0,0,0,.06);
    display:flex;
    justify-content:space-between;
    align-items:center;
    position:sticky;
    top:0;
    z-index:1040;
}
.hamburger{
    background:none;
    border:none;
    font-size:1.8rem;
    color:var(--dark);
    cursor:pointer;
    padding:8px;
    display:none;
}
.topbar h1{
    font-family:'Fraunces',serif;
    color:var(--dark);
    margin:0;
    font-size:1.35rem;
    font-weight:600;
}
.top-right{
    display:flex;
    align-items:center;
    gap:14px;
}
.avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:var(--forest);
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:.82rem;
    font-weight:700;
}
.content{
    padding:24px 20px;
}

/* RESPONSIVE MOBILE */
@media (max-width: 992px) {
    .hamburger{display:block;}
    .sidebar{transform:translateX(-100%);}
    .sidebar.active{transform:translateX(0);}
    .main{margin-left:0;}
}

/* Styles existants adaptés pour mobile */
.success-alert{
    background:#ECFDF3;
    border:1px solid #A7F3D0;
    color:#047857;
    padding:14px 18px;
    border-radius:14px;
    margin-bottom:20px;
}
.table-card{
    background:white;
    border-radius:24px;
    overflow:hidden;
    border:1px solid rgba(0,0,0,.05);
    box-shadow:0 12px 30px rgba(0,0,0,.04);
}
.table-header{
    padding:18px 20px;
    border-bottom:1px solid rgba(0,0,0,.06);
}
.table-container{
    overflow-x:auto;
    -webkit-overflow-scrolling:touch;
}
table{
    width:100%;
    min-width:820px;
    border-collapse:collapse;
}
thead th{
    padding:16px 16px;
    text-transform:uppercase;
    font-size:.72rem;
    color:var(--muted);
    letter-spacing:.08em;
    background:#F9FBF8;
}
tbody td{
    padding:16px 16px;
    border-bottom:1px solid rgba(0,0,0,.05);
    vertical-align:middle;
}
tbody tr:hover{
    background:#FAFCF9;
}
.btn-create{
    border:none;
    background:var(--forest);
    color:white;
    border-radius:14px;
    padding:12px 18px;
    display:flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    transition:.3s;
    font-weight:600;
    white-space:nowrap;
}
.btn-create:hover{
    background:var(--sage);
    transform:translateY(-2px);
}
.btn-edit{
    border:none;
    background:#ECFDF3;
    color:#166534;
    border-radius:10px;
    padding:8px 12px;
    display:flex;
    align-items:center;
    gap:6px;
    text-decoration:none;
    font-size:.85rem;
    font-weight:600;
}
.btn-edit:hover{background:#D1FAE5;}
.btn-del{
    border:none;
    background:#FEF2F2;
    color:#DC2626;
    border-radius:10px;
    padding:8px 12px;
}
.btn-del:hover{background:#FEE2E2;}

/* Badges */
.badge-cat{
    padding:6px 12px;
    border-radius:999px;
    font-size:.74rem;
    font-weight:600;
}
.cat-sensibilisation{background:#DCFCE7;color:#166534;}
.cat-prevention{background:#DBEAFE;color:#1D4ED8;}
.cat-temoignage{background:#F3E8FF;color:#7E22CE;}
.cat-ressource{background:#FEF3C7;color:#B45309;}
.badge-status{
    border-radius:999px;
    padding:6px 12px;
    font-size:.74rem;
    font-weight:600;
}
.status-publie{background:#DCFCE7;color:#166534;}
.status-brouillon{background:#F1F5F9;color:#64748B;}
</style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="/" class="brand-logo">
            <i data-lucide="leaf"></i>
            Jokko<span>Santé</span>
        </a>
        <p>Espace Administrateur</p>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <div class="nav-item">
            <a href="/dashboard">
                <i data-lucide="layout-dashboard"></i>
                Tableau de bord
            </a>
        </div>
    </nav>
</div>

<div class="main">
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:16px;">
            <button class="hamburger" id="hamburgerBtn">
                <i data-lucide="menu"></i>
            </button>
            <h1>Gestion des articles</h1>
        </div>

        <div class="top-right">
            <a href="{{ route('admin.articles.create') }}" class="btn-create">
                <i data-lucide="square-pen"></i>
                Nouvel article
            </a>
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name,0,2)) }}
            </div>
        </div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <div class="table-header">
                <h2>Tous les articles ({{ $articles->count() }})</h2>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Catégorie</th>
                            <th>Statut</th>
                            <th>Auteur</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>
                            <strong>{{ Str::limit($article->titre,50) }}</strong>
                            <div style="font-size:.78rem;color:var(--muted);margin-top:6px;">
                                {{ Str::limit(strip_tags($article->contenu),60) }}
                            </div>
                        </td>
                        <td>
                            <span class="badge-cat cat-{{ $article->categorie }}">
                                {{ ucfirst($article->categorie) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge-status status-{{ $article->statut }}">
                                {{ ucfirst($article->statut) }}
                            </span>
                        </td>
                        <td>{{ $article->auteur->name ?? '—' }}</td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.articles.edit',$article) }}" class="btn-edit">
                                    <i data-lucide="pencil"></i> Modifier
                                </a>
                                <form method="POST" action="{{ route('admin.articles.destroy',$article) }}" 
                                      onsubmit="return confirm('Supprimer cet article ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-del" type="submit">
                                        <i data-lucide="trash-2"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:60px;color:var(--muted);">
                            Aucun article disponible
                        </td>
                    </tr>
                    @endforelse
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
</script>
</body>
</html>