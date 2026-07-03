<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Mes Messages — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;display:flex;align-items:center;gap:8px;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;}
.hero{background:var(--forest);padding:48px 0 36px;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:2rem;font-weight:300;color:white;letter-spacing:-.03em;}
.hero h1 em{font-style:italic;color:var(--light);}
.main{max-width:800px;margin:0 auto;padding:48px 20px;}

/* TABS */
.tabs{display:flex;gap:4px;background:white;border-radius:14px;padding:6px;border:1px solid rgba(0,0,0,.07);margin-bottom:28px;width:fit-content;}
.tab-btn{border:none;background:transparent;border-radius:10px;padding:9px 20px;font-size:.84rem;font-weight:600;font-family:'DM Sans',sans-serif;cursor:pointer;color:var(--muted);transition:all .25s;display:flex;align-items:center;gap:7px;}
.tab-btn i{width:16px;height:16px;}
.tab-btn.active{background:var(--forest);color:white;}
.tab-content{display:none;}
.tab-content.active{display:block;}

/* MESSAGE CARD */
.msg-card{background:white;border-radius:16px;border:1px solid rgba(0,0,0,.07);padding:20px 24px;margin-bottom:12px;transition:all .25s;}
.msg-card:hover{box-shadow:0 8px 24px rgba(26,61,22,.08);}
.msg-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:10px;}
.msg-from{display:flex;align-items:center;gap:10px;}
.msg-avatar{width:38px;height:38px;border-radius:50%;background:var(--forest);display:flex;align-items:center;justify-content:center;color:white;font-size:.76rem;font-weight:700;flex-shrink:0;}
.msg-name{font-weight:600;font-size:.87rem;color:var(--dark);}
.msg-date{font-size:.74rem;color:var(--muted);margin-top:2px;}
.msg-content{font-size:.87rem;color:#2a3a28;line-height:1.75;padding-top:10px;border-top:1px solid rgba(0,0,0,.05);}
.badge-anon{background:var(--light);color:var(--sage);padding:2px 10px;border-radius:50px;font-size:.7rem;font-weight:700;margin-left:6px;}

/* BOUTON RÉPONDRE */
.reply-toggle{
    display:inline-flex;align-items:center;gap:6px;
    background:#f0f9ed;color:var(--forest);
    border:1.5px solid #c8e6c0;border-radius:8px;
    padding:7px 14px;font-size:.78rem;font-weight:600;
    cursor:pointer;margin-top:12px;
    font-family:'DM Sans',sans-serif;
    transition:all .2s;
}
.reply-toggle:hover{background:var(--light);border-color:var(--sage);}
.reply-toggle i{width:14px;height:14px;}

/* FORMULAIRE RÉPONSE */
.reply-form{
    display:none;
    margin-top:12px;
    padding:16px;
    background:#f8fdf6;
    border-radius:12px;
    border:1px solid #dce8d8;
}
.reply-form.show{display:block;animation:slideDown .25s ease;}
@keyframes slideDown{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
.reply-form textarea{
    width:100%;padding:11px 14px;
    border:1.5px solid #dce8d8;border-radius:10px;
    font-family:'DM Sans',sans-serif;font-size:.86rem;
    color:var(--dark);background:white;outline:none;
    resize:vertical;min-height:88px;
    transition:border-color .2s;
}
.reply-form textarea:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.08);}
.reply-form-footer{display:flex;align-items:center;justify-content:space-between;margin-top:10px;gap:10px;flex-wrap:wrap;}
.reply-form-info{font-size:.74rem;color:var(--muted);display:flex;align-items:center;gap:5px;}
.reply-form-info i{width:13px;height:13px;}
.reply-form-actions{display:flex;gap:8px;}
.btn-cancel{background:none;border:1.5px solid #dce8d8;border-radius:8px;padding:7px 14px;font-size:.8rem;font-weight:600;color:var(--muted);cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .2s;}
.btn-cancel:hover{border-color:var(--muted);color:var(--dark);}
.btn-send{background:var(--forest);color:white;border:none;border-radius:8px;padding:8px 18px;font-size:.82rem;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;display:inline-flex;align-items:center;gap:7px;transition:all .2s;}
.btn-send:hover{background:var(--sage);transform:translateY(-1px);}
.btn-send i{width:15px;height:15px;}

/* BADGE SUCCÈS */
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;display:flex;align-items:center;gap:8px;}
.alert-success i{width:18px;height:18px;flex-shrink:0;}

/* EMPTY */
.empty{text-align:center;padding:48px;color:var(--muted);font-size:.88rem;}
.empty-icon{font-size:3rem;margin-bottom:12px;}

/* SENT AVATAR */
.msg-avatar-sent{background:linear-gradient(135deg,#3b82f6,#2563eb);}

/* ROLE BADGE */
.role-pill{display:inline-flex;align-items:center;gap:4px;font-size:.68rem;font-weight:700;padding:2px 8px;border-radius:999px;margin-left:6px;}
.role-pill.psycho{background:#dbeafe;color:#1e40af;}
.role-pill.pair{background:#ede9fe;color:#6d28d9;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">
            <i data-lucide="leaf" style="width:22px;height:22px;stroke:var(--light);"></i>
            Jokko<span>Santé</span>
        </a>
        <a href="/dashboard" class="btn-nav">← Mon espace</a>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Mes <em>messages</em></h1>
    </div>
</div>

<div class="main">

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert-success">
        <i data-lucide="check-circle"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- TABS --}}
    <div class="tabs">
        <button class="tab-btn active" onclick="switchTab('recus', this)">
            <i data-lucide="inbox"></i>
            Reçus ({{ $messagesRecus->count() }})
        </button>
        <button class="tab-btn" onclick="switchTab('envoyes', this)">
            <i data-lucide="send"></i>
            Envoyés ({{ $messagesEnvoyes->count() }})
        </button>
    </div>

    {{-- ════ MESSAGES REÇUS ════ --}}
    <div class="tab-content active" id="tab-recus">
        @forelse($messagesRecus as $msg)
        <div class="msg-card">

            {{-- EN-TÊTE --}}
            <div class="msg-header">
                <div class="msg-from">
                    <div class="msg-avatar">
                        {{ $msg->anonyme ? '?' : strtoupper(substr($msg->expediteur->name ?? 'A', 0, 2)) }}
                    </div>
                    <div>
                        <div class="msg-name">
                            De :
                            {{ $msg->anonyme ? 'Anonyme' : ($msg->expediteur->name ?? 'Utilisateur') }}
                            @if($msg->anonyme)
                                <span class="badge-anon">Anonyme</span>
                            @endif
                            {{-- Badge rôle expéditeur --}}
                            @if(!$msg->anonyme && $msg->expediteur)
                                @php $roleExp = $msg->expediteur->role->nom ?? ''; @endphp
                                @if($roleExp === 'psychologue')
                                    <span class="role-pill psycho">🩺 Psychologue</span>
                                @elseif($roleExp === 'pair_aidant')
                                    <span class="role-pill pair">🤝 Pair-aidant</span>
                                @endif
                            @endif
                        </div>
                        <div class="msg-date">
                            <i data-lucide="clock" style="width:12px;height:12px;display:inline;vertical-align:middle;"></i>
                            {{ $msg->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENU --}}
            <div class="msg-content">{{ $msg->contenu }}</div>

            {{-- BOUTON RÉPONDRE — uniquement si expéditeur non anonyme --}}
            @if(!$msg->anonyme && $msg->expediteur)
            <button class="reply-toggle" onclick="toggleReply('reply-{{ $msg->id }}', this)">
                <i data-lucide="corner-up-left"></i>
                Répondre à {{ $msg->expediteur->name }}
            </button>

            {{-- FORMULAIRE RÉPONSE --}}
            <div class="reply-form" id="reply-{{ $msg->id }}">
                <form method="POST" action="{{ route('assistance.message.send') }}">
                    @csrf
                    <input type="hidden" name="destinataire_id" value="{{ $msg->expediteur_id }}">

                    <textarea
                        name="contenu"
                        placeholder="Écrivez votre réponse à {{ $msg->expediteur->name }}..."
                        required
                        minlength="5"
                    ></textarea>

                    <div class="reply-form-footer">
                        <div class="reply-form-info">
                            <i data-lucide="shield"></i>
                            Message privé · confidentiel
                        </div>
                        <div class="reply-form-actions">
                            <button type="button" class="btn-cancel"
                                onclick="toggleReply('reply-{{ $msg->id }}', null)">
                                Annuler
                            </button>
                            <button type="submit" class="btn-send">
                                <i data-lucide="send"></i>
                                Envoyer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endif

        </div>
        @empty
        <div class="empty">
            <div class="empty-icon">📥</div>
            <p>Aucun message reçu pour le moment</p>
        </div>
        @endforelse
    </div>

    {{-- ════ MESSAGES ENVOYÉS ════ --}}
    <div class="tab-content" id="tab-envoyes">
        @forelse($messagesEnvoyes as $msg)
        <div class="msg-card">
            <div class="msg-header">
                <div class="msg-from">
                    <div class="msg-avatar msg-avatar-sent">
                        {{ strtoupper(substr($msg->destinataire->name ?? 'A', 0, 2)) }}
                    </div>
                    <div>
                        <div class="msg-name">
                            À : {{ $msg->destinataire->name ?? 'Utilisateur' }}
                            @if($msg->anonyme)<span class="badge-anon">Anonyme</span>@endif
                            {{-- Badge rôle destinataire --}}
                            @if($msg->destinataire)
                                @php $roleDest = $msg->destinataire->role->nom ?? ''; @endphp
                                @if($roleDest === 'psychologue')
                                    <span class="role-pill psycho">🩺 Psychologue</span>
                                @elseif($roleDest === 'pair_aidant')
                                    <span class="role-pill pair">🤝 Pair-aidant</span>
                                @endif
                            @endif
                        </div>
                        <div class="msg-date">
                            <i data-lucide="clock" style="width:12px;height:12px;display:inline;vertical-align:middle;"></i>
                            {{ $msg->created_at->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>
                <div style="display:flex;align-items:center;gap:6px;">
                    <i data-lucide="check-check" style="width:16px;height:16px;color:var(--sage);"></i>
                    <span style="font-size:.72rem;color:var(--muted);">Envoyé</span>
                </div>
            </div>
            <div class="msg-content">{{ $msg->contenu }}</div>
        </div>
        @empty
        <div class="empty">
            <div class="empty-icon">📤</div>
            <p>Aucun message envoyé pour le moment</p>
        </div>
        @endforelse
    </div>

</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);margin-top:40px;">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">
            🌿 Jokko<span style="color:var(--light);">Santé</span>
        </p>
        <p style="color:rgba(255,255,255,.4);font-size:.76rem;">
            Urgences : 116 · 17 · 800 00 19 19
        </p>
        <p style="color:rgba(255,255,255,.3);font-size:.76rem;margin-top:4px;">
            © {{ date('Y') }} Jokko Santé — Tous droits réservés
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
lucide.createIcons();

// Switch tabs
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}

// Toggle formulaire réponse
function toggleReply(id, btn) {
    const form = document.getElementById(id);
    const isOpen = form.classList.contains('show');

    // Fermer tous les formulaires ouverts
    document.querySelectorAll('.reply-form.show').forEach(f => f.classList.remove('show'));

    // Ouvrir celui cliqué si c'était fermé
    if (!isOpen) {
        form.classList.add('show');
        // Focus sur le textarea
        setTimeout(() => form.querySelector('textarea').focus(), 100);
    }
}
</script>
</body>
</html>