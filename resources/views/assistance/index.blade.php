<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assistance — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--mint:#3A6B2F;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;}
.btn-nav:hover{background:white;color:var(--forest);}
.nav-link-c{color:rgba(255,255,255,.7);text-decoration:none;font-size:.88rem;margin-left:24px;transition:color .25s;}
.nav-link-c:hover{color:white;}

/* HERO */
.hero{background:var(--forest);padding:56px 0 40px;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:2.5rem;font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:12px;}
.hero h1 em{font-style:italic;color:var(--light);}
.hero p{color:rgba(255,255,255,.65);font-size:.95rem;max-width:520px;margin:0 auto;line-height:1.8;}

/* TABS */
.tabs-wrap{background:white;border-bottom:1px solid rgba(0,0,0,.07);position:sticky;top:65px;z-index:50;}
.tabs{display:flex;max-width:1200px;margin:0 auto;padding:0 20px;}
.tab-btn{border:none;background:transparent;padding:16px 24px;font-size:.88rem;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;color:var(--muted);border-bottom:3px solid transparent;transition:all .25s;margin-bottom:-1px;}
.tab-btn:hover{color:var(--forest);}
.tab-btn.active{color:var(--forest);border-bottom-color:var(--forest);}
.tab-content{display:none;padding:48px 0;}
.tab-content.active{display:block;}

/* FORUM */
.forum-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:24px 28px;margin-bottom:16px;transition:all .35s;text-decoration:none;display:block;}
.forum-card:hover{transform:translateY(-4px);box-shadow:0 16px 40px rgba(26,61,22,.1);}
.forum-tag{display:inline-block;background:var(--light);color:var(--forest);padding:3px 12px;border-radius:50px;font-size:.72rem;font-weight:700;margin-bottom:10px;}
.forum-card h3{font-family:'Fraunces',serif;font-size:1.05rem;font-weight:600;color:var(--dark);margin-bottom:8px;letter-spacing:-.02em;}
.forum-card p{font-size:.85rem;color:var(--muted);line-height:1.6;margin-bottom:14px;}
.forum-meta{display:flex;align-items:center;gap:16px;font-size:.76rem;color:var(--muted);}
.forum-meta span{display:flex;align-items:center;gap:4px;}

/* FORM CARD */
.form-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:32px;margin-bottom:32px;}
.form-card h3{font-family:'Fraunces',serif;font-size:1.1rem;font-weight:600;color:var(--dark);margin-bottom:20px;}
label{display:block;font-size:.8rem;font-weight:600;color:var(--dark);margin-bottom:7px;letter-spacing:.02em;}
input[type=text],textarea,select{width:100%;padding:12px 16px;border:1.5px solid #e0e8dc;border-radius:12px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;transition:border-color .25s;}
input:focus,textarea:focus,select:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.1);background:white;}
textarea{resize:vertical;min-height:120px;}
.field{margin-bottom:18px;}
.check-row{display:flex;align-items:center;gap:8px;margin-bottom:18px;}
.check-row input{accent-color:var(--sage);width:15px;height:15px;}
.check-row label{font-size:.84rem;color:var(--muted);margin:0;}
.btn-submit{background:var(--forest);color:white;border:none;border-radius:50px;padding:12px 32px;font-size:.9rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;box-shadow:0 4px 16px rgba(26,61,22,.2);}
.btn-submit:hover{background:var(--sage);transform:translateY(-2px);}

/* CONTACT CARDS */
.contact-card{background:white;border-radius:16px;border:1px solid rgba(0,0,0,.07);padding:20px 22px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;gap:16px;}
.contact-avatar{width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-size:.88rem;font-weight:700;flex-shrink:0;}
.avatar-psycho{background:#3b82f6;}
.avatar-pair{background:var(--forest);}
.btn-contact{background:var(--light);color:var(--forest);border:1.5px solid rgba(26,61,22,.15);border-radius:50px;padding:7px 18px;font-size:.78rem;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .25s;}
.btn-contact:hover{background:var(--forest);color:white;border-color:var(--forest);}

/* MESSAGE MODAL */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:200;align-items:center;justify-content:center;}
.modal-overlay.open{display:flex;}
.modal-box{background:white;border-radius:24px;padding:36px;width:100%;max-width:480px;box-shadow:0 32px 80px rgba(0,0,0,.3);}
.modal-box h3{font-family:'Fraunces',serif;font-size:1.2rem;font-weight:600;color:var(--dark);margin-bottom:20px;}
.btn-close-modal{background:none;border:none;font-size:1.2rem;cursor:pointer;color:var(--muted);float:right;margin-top:-8px;}

/* ALERTS */
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.alert-err{background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}

/* EMPTY */
.empty-state{text-align:center;padding:60px 20px;}
.empty-state h3{font-family:'Fraunces',serif;font-size:1.3rem;color:var(--dark);margin-bottom:10px;}
.empty-state p{color:var(--muted);font-size:.88rem;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <div class="d-flex align-items-center">
            <a href="/sensibilisation" class="nav-link-c">Sensibilisation</a>
            <a href="/assistance/messages" class="nav-link-c">Mes messages</a>
            <a href="/dashboard" class="btn-nav" style="margin-left:16px;">Mon espace</a>
        </div>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Espace <em>assistance</em></h1>
        <p>Forum communautaire, chat anonyme et contact direct avec nos psychologues et pair-aidants. Vous n'êtes jamais seul(e).</p>
    </div>
</div>

<div class="tabs-wrap">
    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('forum', this)">💬 Forum communautaire</button>
        <button class="tab-btn" onclick="switchTab('contact', this)">🩺 Contacter un professionnel</button>
    </div>
</div>

<div class="container" style="max-width:900px;">

    @if(session('success'))
        <div style="margin-top:24px;">
            <div class="alert-success">✅ {{ session('success') }}</div>
        </div>
    @endif
    @if($errors->any())
        <div style="margin-top:24px;">
            <div class="alert-err">
                @foreach($errors->all() as $e)<div>❌ {{ $e }}</div>@endforeach
            </div>
        </div>
    @endif

    {{-- TAB FORUM --}}
    <div class="tab-content active" id="tab-forum">

        {{-- FORMULAIRE NOUVEAU SUJET --}}
        <div class="form-card">
            <h3>✏️ Créer une nouvelle discussion</h3>
            <form method="POST" action="{{ route('assistance.forum.store') }}">
                @csrf
                <div class="field">
                    <label>Titre de votre discussion</label>
                    <input type="text" name="titre" value="{{ old('titre') }}"
                           placeholder="Ex: Comment gérer le stress des examens ?" required>
                </div>
                <div class="field">
                    <label>Contenu</label>
                    <textarea name="contenu" placeholder="Décrivez votre situation, posez votre question..." required>{{ old('contenu') }}</textarea>
                </div>
                <div class="check-row">
                    <input type="checkbox" name="anonyme" id="anonyme" value="1">
                    <label for="anonyme">Publier anonymement (votre nom ne sera pas affiché)</label>
                </div>
                <button type="submit" class="btn-submit">🌿 Publier la discussion</button>
            </form>
        </div>

        {{-- LISTE DES DISCUSSIONS --}}
        @if($forums->count() > 0)
            @foreach($forums as $forum)
            <a href="{{ route('assistance.forum.show', $forum) }}" class="forum-card">
                <span class="forum-tag">💬 Discussion</span>
                <h3>{{ $forum->titre }}</h3>
                <p>{{ Str::limit(strip_tags($forum->contenu), 130) }}</p>
                <div class="forum-meta">
                    <span>👤 {{ $forum->anonyme ? 'Anonyme' : ($forum->auteur->name ?? 'Utilisateur') }}</span>
                    <span>💬 {{ $forum->reponses->count() }} réponse(s)</span>
                    <span>🕐 {{ $forum->created_at->diffForHumans() }}</span>
                </div>
            </a>
            @endforeach
        @else
            <div class="empty-state">
                <div style="font-size:4rem;margin-bottom:16px;">💬</div>
                <h3>Aucune discussion pour le moment</h3>
                <p>Soyez le premier à lancer une discussion communautaire.</p>
            </div>
        @endif

    </div>

    {{-- TAB CONTACT --}}
    <div class="tab-content" id="tab-contact">

        @if($psychologues->count() > 0)
        <div style="margin-bottom:32px;">
            <p style="font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;">🩺 Psychologues disponibles</p>
            @foreach($psychologues as $psycho)
            <div class="contact-card">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="contact-avatar avatar-psycho">{{ strtoupper(substr($psycho->name, 0, 2)) }}</div>
                    <div>
                        <p style="font-weight:600;font-size:.9rem;color:var(--dark);margin:0;">Dr. {{ $psycho->name }}</p>
                        <p style="font-size:.78rem;color:var(--muted);margin:3px 0 0;">🩺 Psychologue · {{ $psycho->universite ?? 'Jokko Santé' }}</p>
                    </div>
                </div>
                <div style="display:flex;gap:8px;">
                    <a href="/rendezvous" class="btn-contact">📅 Rendez-vous</a>
                    <button class="btn-contact" onclick="openMessage({{ $psycho->id }}, 'Dr. {{ $psycho->name }}')">
                        💬 Message
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @if($pairAidants->count() > 0)
        <div>
            <p style="font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);margin-bottom:16px;">🤝 Pair-aidants disponibles</p>
            @foreach($pairAidants as $pair)
            <div class="contact-card">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="contact-avatar avatar-pair">{{ strtoupper(substr($pair->name, 0, 2)) }}</div>
                    <div>
                        <p style="font-weight:600;font-size:.9rem;color:var(--dark);margin:0;">{{ $pair->name }}</p>
                        <p style="font-size:.78rem;color:var(--muted);margin:3px 0 0;">🤝 Pair-aidant · Badienou Gokh</p>
                    </div>
                </div>
                <button class="btn-contact" onclick="openMessage({{ $pair->id }}, '{{ $pair->name }}')">
                    💬 Message
                </button>
            </div>
            @endforeach
        </div>
        @endif

        @if($psychologues->count() === 0 && $pairAidants->count() === 0)
        <div class="empty-state">
            <div style="font-size:4rem;margin-bottom:16px;">🩺</div>
            <h3>Aucun professionnel disponible</h3>
            <p>Des psychologues et pair-aidants seront ajoutés prochainement.</p>
        </div>
        @endif

    </div>

</div>

{{-- MODAL MESSAGE --}}
<div class="modal-overlay" id="messageModal">
    <div class="modal-box">
        <button class="btn-close-modal" onclick="closeMessage()">✕</button>
        <h3>💬 Envoyer un message</h3>
        <p style="font-size:.84rem;color:var(--muted);margin-bottom:20px;">À : <strong id="recipientName"></strong></p>
        <form method="POST" action="{{ route('assistance.message.send') }}">
            @csrf
            <input type="hidden" name="destinataire_id" id="destinataireId">
            <div class="field">
                <label>Votre message</label>
                <textarea name="contenu" placeholder="Écrivez votre message ici..." required style="min-height:140px;"></textarea>
            </div>
            <div class="check-row">
                <input type="checkbox" name="anonyme" id="msg-anonyme" value="1">
                <label for="msg-anonyme">Envoyer anonymement</label>
            </div>
            <button type="submit" class="btn-submit" style="width:100%;">📨 Envoyer le message</button>
        </form>
    </div>
</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);margin-top:40px;">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}

function openMessage(id, name) {
    document.getElementById('destinataireId').value = id;
    document.getElementById('recipientName').textContent = name;
    document.getElementById('messageModal').classList.add('open');
}

function closeMessage() {
    document.getElementById('messageModal').classList.remove('open');
}

document.getElementById('messageModal').addEventListener('click', function(e) {
    if (e.target === this) closeMessage();
});
</script>
</body>
</html>