<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sensibilisation — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--mint:#3A6B2F;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.nav-link-item{color:rgba(255,255,255,.7);text-decoration:none;font-size:.88rem;font-weight:500;transition:color .25s;margin-left:24px;}
.nav-link-item:hover{color:white;}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;transition:all .3s;margin-left:16px;}
.btn-nav:hover{background:white;color:var(--forest);}

/* HERO */
.hero{background:var(--forest);padding:72px 0;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:clamp(2rem,4vw,3.2rem);font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:16px;}
.hero h1 em{font-style:italic;color:var(--light);}
.hero p{color:rgba(255,255,255,.65);font-size:1rem;max-width:520px;margin:0 auto;line-height:1.8;}

/* FILTRES */
.filters{background:white;border-bottom:1px solid rgba(0,0,0,.07);padding:16px 0;position:sticky;top:65px;z-index:50;}
.filter-btn{border:1.5px solid #e0e8dc;border-radius:50px;padding:7px 18px;font-size:.82rem;font-weight:600;font-family:'DM Sans',sans-serif;background:white;cursor:pointer;color:var(--muted);transition:all .25s;margin-right:8px;}
.filter-btn:hover,.filter-btn.active{background:var(--forest);color:white;border-color:var(--forest);}

/* ARTICLES */
.articles-section{padding:60px 0;}
.article-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);overflow:hidden;height:100%;transition:all .4s cubic-bezier(.16,1,.3,1);text-decoration:none;display:block;}
.article-card:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(26,61,22,.13);}
.article-card-top{padding:28px 28px 20px;}
.article-cat{display:inline-block;padding:4px 14px;border-radius:50px;font-size:.72rem;font-weight:700;letter-spacing:.06em;text-transform:uppercase;margin-bottom:16px;}
.cat-sensibilisation{background:#dcfce7;color:#166534;}
.cat-temoignage{background:#f3e8ff;color:#6b21a8;}
.cat-ressource{background:#fef3c7;color:#92400e;}
.cat-prevention{background:#dbeafe;color:#1e40af;}
.article-card h3{font-family:'Fraunces',serif;font-size:1.2rem;font-weight:600;color:var(--dark);line-height:1.35;margin-bottom:12px;letter-spacing:-.02em;}
.article-card p{color:var(--muted);font-size:.87rem;line-height:1.7;}
.article-card-footer{padding:16px 28px;border-top:1px solid rgba(0,0,0,.06);display:flex;align-items:center;justify-content:space-between;}
.article-author{font-size:.78rem;color:var(--muted);}
.article-link{font-size:.82rem;font-weight:700;color:var(--sage);}
.empty-state{text-align:center;padding:80px 20px;}
.empty-state h3{font-family:'Fraunces',serif;font-size:1.5rem;color:var(--dark);margin-bottom:12px;}
.empty-state p{color:var(--muted);font-size:.9rem;}

/* CARTE TEMOIGNAGE — alignée sur .article-card (même largeur/hauteur/ombre/hover/espacement) */
.temoignage-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);overflow:hidden;height:100%;transition:all .4s cubic-bezier(.16,1,.3,1);display:flex;flex-direction:column;}
.temoignage-card:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(26,61,22,.13);}
.temoignage-card-body{padding:28px 28px 20px;flex:1;display:flex;flex-direction:column;}
.temoignage-avatar{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,var(--forest),var(--mint));display:flex;align-items:center;justify-content:center;color:white;font-size:.8rem;font-weight:700;flex-shrink:0;}
.temoignage-author{font-weight:600;font-size:.88rem;color:var(--dark);}
.temoignage-anon-badge{background:var(--light);color:var(--sage);padding:2px 8px;border-radius:999px;font-size:.66rem;font-weight:700;margin-left:4px;}
.temoignage-date{font-size:.72rem;color:var(--muted);}
.temoignage-card h4{font-family:'Fraunces',serif;font-size:1.2rem;font-weight:600;color:var(--dark);line-height:1.35;margin-bottom:12px;letter-spacing:-.02em;}
.temoignage-card p{color:var(--muted);font-size:.87rem;line-height:1.7;}
.temoignage-comment-block{background:var(--cream);border-radius:14px;padding:14px 16px;margin-bottom:10px;}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <div class="d-flex align-items-center">
            <a href="/sensibilisation" class="nav-link-item">Sensibilisation</a>
            <a href="/assistance" class="nav-link-item">Assistance</a>
            @auth
                <a href="/dashboard" class="btn-nav">Mon espace</a>
            @else
                <a href="/login" class="nav-link-item">Connexion</a>
                <a href="/register" class="btn-nav">S'inscrire</a>
            @endauth
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <div class="container">
        <h1>Comprendre la <em>santé mentale</em></h1>
        <p>Articles éducatifs, témoignages et ressources pour briser les tabous et mieux comprendre votre bien-être psychologique.</p>
    </div>
</div>

<!-- FILTRES -->
<div class="filters">
    <div class="container">
        <button class="filter-btn active" onclick="filterArticles('all', this)">Tous</button>
        <button class="filter-btn" onclick="filterArticles('sensibilisation', this)">📚 Sensibilisation</button>
        <button class="filter-btn" onclick="filterArticles('temoignage', this)">💬 Témoignages</button>
        <button class="filter-btn" onclick="filterArticles('ressource', this)">🔗 Ressources</button>
    </div>
</div>

<!-- ARTICLES -->
<div class="articles-section">
    <div class="container">
        @if($articles->count() > 0)
            <div class="row g-4" id="articlesGrid">
                @foreach($articles as $article)
                <div class="col-md-6 col-lg-4 article-item" data-cat="{{ $article->categorie }}">
                    <a href="{{ route('sensibilisation.show', $article) }}" class="article-card">
                        <div class="article-card-top">
                            <span class="article-cat cat-{{ $article->categorie }}">
                                {{ ucfirst($article->categorie) }}
                            </span>
                            <h3>{{ $article->titre }}</h3>
                            <p>{{ Str::limit(strip_tags($article->contenu), 120) }}</p>
                        </div>
                        <div class="article-card-footer">
                            <span class="article-author">Par {{ $article->auteur->name ?? 'Équipe Jokko Santé' }} · {{ $article->created_at->format('d/m/Y') }}</span>
                            <span class="article-link">Lire →</span>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div style="font-size:4rem;margin-bottom:20px;">📚</div>
                <h3>Aucun article pour le moment</h3>
                <p>Les articles seront publiés prochainement par notre équipe.</p>
                @auth @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.articles.create') }}" style="display:inline-block;margin-top:20px;background:var(--forest);color:white;padding:12px 28px;border-radius:12px;text-decoration:none;font-weight:600;">
                        ✏️ Créer le premier article
                    </a>
                @endif @endauth
            </div>
        @endif
    </div>
</div>


{{-- SECTION TÉMOIGNAGES --}}
@if(isset($temoignages) && $temoignages->count() > 0)
<div id="temoignages-section"
     style="background:white;padding:60px 0;border-top:1px solid rgba(0,0,0,.06);margin-top:20px;">
    <div class="container">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:12px;">
            <div>
                <span style="font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--sage);">Communauté</span>
                <h2 style="font-family:'Fraunces',serif;font-size:1.8rem;font-weight:300;color:var(--dark);margin-top:4px;">
                    Témoignages <em style="font-style:italic;color:var(--sage);">de la communauté</em>
                </h2>
            </div>
            @auth
                @if(Auth::user()->role->nom === 'utilisateur')
                <a href="{{ route('temoignages.create') }}"
                   style="display:inline-flex;align-items:center;gap:8px;background:var(--forest);color:white;padding:11px 22px;border-radius:50px;font-size:.86rem;font-weight:700;text-decoration:none;">
                    ❤️ Partager mon témoignage
                </a>
                @endif
            @endauth
        </div>

        <div class="row g-4">
            @foreach($temoignages as $temoignage)
            <div class="col-md-6 col-lg-4">
                <div class="temoignage-card">
                    <div class="temoignage-card-body">
                        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
                            <div class="temoignage-avatar">
                                {{ $temoignage->anonyme ? '?' : strtoupper(substr($temoignage->auteur->name ?? 'A', 0, 2)) }}
                            </div>
                            <div>
                                <div class="temoignage-author">
                                    {{ $temoignage->anonyme ? 'Anonyme' : ($temoignage->auteur->name ?? 'Utilisateur') }}
                                    @if($temoignage->anonyme)
                                        <span class="temoignage-anon-badge">Anonyme</span>
                                    @endif
                                </div>
                                <div class="temoignage-date">{{ $temoignage->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <h4>{{ $temoignage->titre }}</h4>
                        <p>{{ Str::limit($temoignage->contenu, 180) }}</p>
                        <hr>

@auth
@if(Auth::user()->role->nom === 'utilisateur')

<button
class="btn btn-success btn-sm mt-2"
data-bs-toggle="collapse"
data-bs-target="#commentaire{{ $temoignage->id }}">

Commenter

</button>

@endif
@endauth

<div class="collapse mt-3" id="commentaire{{ $temoignage->id }}">

<form
method="POST"
action="{{ route('temoignages.commentaires.store',$temoignage) }}">

@csrf

<div class="mb-3">

<textarea
name="contenu"
class="form-control"
rows="3"
placeholder="Écrivez votre commentaire..."
required></textarea>

</div>

<div class="form-check mb-3">

<input
class="form-check-input"
type="checkbox"
name="anonyme"
value="1"
id="anon{{ $temoignage->id }}">

<label
class="form-check-label"
for="anon{{ $temoignage->id }}">

Commenter anonymement

</label>

</div>

<button
type="submit"
class="btn btn-success">

Publier

</button>

</form>

</div>
@if($temoignage->commentaires->count())

<hr>

<h6>Commentaires</h6>

@foreach($temoignage->commentaires as $commentaire)

<div class="temoignage-comment-block">

<strong>

{{ $commentaire->anonyme
? 'Anonyme'
: $commentaire->auteur->name }}

</strong>

<small class="text-muted">

•

{{ $commentaire->created_at->diffForHumans() }}

</small>

<p class="mb-0 mt-2">

{{ $commentaire->contenu }}

</p>

</div>

@endforeach

@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- FOOTER -->
<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function filterArticles(cat, btn) {

document.querySelectorAll('.filter-btn').forEach(function(b){
    b.classList.remove('active');
});

btn.classList.add('active');

// Filtrer les ARTICLES
document.querySelectorAll('.article-item').forEach(function(item){

    if(cat === 'all'){
        item.style.display = '';
    }else{
        item.style.display =
            item.dataset.cat === cat ? '' : 'none';
    }

});

// Filtrer la SECTION TÉMOIGNAGES
const temoignages = document.getElementById('temoignages-section');

if(temoignages){

    if(cat === 'all' || cat === 'temoignage'){
        temoignages.style.display = '';
    }else{
        temoignages.style.display = 'none';
    }

}

}
</script>
</body>
</html>