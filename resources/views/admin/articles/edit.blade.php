<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Modifier Article — Jokko Santé</title>
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
    --card:#ffffff;
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
    font-size:.9rem;
    transition:.3s ease;
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
    padding:20px 34px;
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
    font-size:1.4rem;
    margin:0;
    color:var(--dark);
}
.back-link{
    text-decoration:none;
    color:var(--muted);
    display:flex;
    align-items:center;
    gap:8px;
    font-size:.88rem;
}
.content{
    padding:34px;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .hamburger{display:block;}
    .sidebar{transform:translateX(-100%);}
    .sidebar.active{transform:translateX(0);}
    .main{margin-left:0;}
}

/* Styles du formulaire */
.form-card{
    background:var(--card);
    border-radius:22px;
    padding:36px;
    border:1px solid rgba(0,0,0,.06);
    box-shadow:0 12px 30px rgba(0,0,0,.04);
}
label{
    font-size:.85rem;
    font-weight:600;
    margin-bottom:8px;
    color:var(--dark);
}
.field{
    margin-bottom:24px;
}
.row2{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}
input[type=text], select, textarea{
    width:100%;
    border:1.5px solid #e4eadf;
    border-radius:14px;
    padding:14px 16px;
    font-size:.92rem;
    background:#fafcf9;
    outline:none;
    transition:.25s ease;
}
input:focus, select:focus, textarea:focus{
    border-color:var(--sage);
    background:white;
    box-shadow:0 0 0 4px rgba(45,90,39,.1);
}
textarea{
    resize:vertical;
    min-height:260px;
}
.actions{
    display:flex;
    align-items:center;
    margin-top:10px;
}
.btn-cancel{
    border:1px solid #dbe4d5;
    background:white;
    color:var(--muted);
    border-radius:12px;
    padding:12px 20px;
    text-decoration:none;
    margin-right:12px;
    transition:.3s;
}
.btn-cancel:hover{
    border-color:var(--sage);
    color:var(--forest);
}
.btn-submit{
    border:none;
    background:var(--forest);
    color:white;
    border-radius:14px;
    padding:13px 28px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
    transition:.3s;
}
.btn-submit:hover{
    background:var(--sage);
    transform:translateY(-2px);
}
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
                <i data-lucide="layout-dashboard" class="icon"></i>
                Tableau de bord
            </a>
        </div>

       
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="logout-btn">
                <i data-lucide="log-out"></i>
                Déconnexion
            </button>
        </form>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:16px;">
            <button class="hamburger" id="hamburgerBtn">
                <i data-lucide="menu"></i>
            </button>
            <h1>Modifier l'article</h1>
        </div>

        <a href="{{ route('admin.articles.index') }}" class="back-link">
            <i data-lucide="arrow-left"></i>
            Retour aux articles
        </a>
    </div>

    <div class="content">
        <div class="form-card">
            <form method="POST" action="{{ route('admin.articles.update', $article) }}">
                @csrf
                @method('PUT')

                <div class="field">
                    <label>Titre de l'article</label>
                    <input type="text" name="titre" value="{{ old('titre', $article->titre) }}" required>
                </div>

                <div class="row2">
                    <div class="field">
                        <label>Catégorie</label>
                        <select name="categorie" required>
                            <option value="sensibilisation" {{ $article->categorie=='sensibilisation'?'selected':'' }}>Sensibilisation</option>
                            <option value="prevention" {{ $article->categorie=='prevention'?'selected':'' }}>Prévention</option>
                            <option value="temoignage" {{ $article->categorie=='temoignage'?'selected':'' }}>Témoignage</option>
                            <option value="ressource" {{ $article->categorie=='ressource'?'selected':'' }}>Ressource</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>Statut</label>
                        <select name="statut" required>
                            <option value="brouillon" {{ $article->statut=='brouillon'?'selected':'' }}>Brouillon</option>
                            <option value="publie" {{ $article->statut=='publie'?'selected':'' }}>Publié</option>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label>Contenu</label>
                    <textarea name="contenu" required>{{ old('contenu', $article->contenu) }}</textarea>
                </div>

                <div class="actions">
                    <a href="{{ route('admin.articles.index') }}" class="btn-cancel">Annuler</a>
                    <button type="submit" class="btn-submit">
                        <i data-lucide="save"></i>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
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