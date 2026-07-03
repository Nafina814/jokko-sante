<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Assistant IA — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html,body{height:100%;overflow:hidden;}
body{font-family:'DM Sans',sans-serif;background:#F5F9F4;display:flex;flex-direction:column;}
.navbar{background:var(--forest);padding:13px 20px;display:flex;align-items:center;justify-content:space-between;flex-shrink:0;}
.brand{font-family:'Fraunces',serif;font-size:1.4rem;font-weight:600;color:white;text-decoration:none;}
.brand span{color:var(--light);}
.back-btn{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:7px 18px;font-size:.82rem;font-weight:700;text-decoration:none;}
.chat-container{flex:1;display:flex;flex-direction:column;max-width:720px;width:100%;margin:0 auto;padding:16px;overflow:hidden;}
.chat-header{text-align:center;padding:10px 0;flex-shrink:0;}
.chat-header h2{font-family:'Fraunces',serif;font-size:1.4rem;font-weight:300;color:var(--dark);margin-bottom:4px;}
.chat-header p{font-size:.8rem;color:var(--muted);}
.alerte-box{background:#fef2f2;border:2px solid #dc2626;border-radius:12px;padding:12px 16px;margin-bottom:10px;font-size:.82rem;color:#7f1d1d;flex-shrink:0;animation:pulse-b 2s infinite;}
@keyframes pulse-b{0%,100%{border-color:#fca5a5;}50%{border-color:#dc2626;}}
.messages-zone{flex:1;overflow-y:auto;display:flex;flex-direction:column;gap:12px;padding:4px 2px;margin-bottom:12px;}
.messages-zone::-webkit-scrollbar{width:4px;}
.messages-zone::-webkit-scrollbar-thumb{background:rgba(0,0,0,.1);border-radius:2px;}
.msg{display:flex;gap:8px;align-items:flex-end;max-width:82%;}
.msg.bot{align-self:flex-start;}
.msg.user{align-self:flex-end;flex-direction:row-reverse;}
.avatar{width:30px;height:30px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;flex-shrink:0;}
.avatar.bot{background:var(--forest);color:white;}
.avatar.user{background:var(--light);color:var(--forest);}
.bubble{padding:10px 14px;border-radius:18px;font-size:.87rem;line-height:1.65;word-wrap:break-word;}
.bubble.bot{background:white;color:var(--dark);border:1px solid rgba(0,0,0,.08);border-bottom-left-radius:4px;}
.bubble.user{background:var(--forest);color:white;border-bottom-right-radius:4px;}
.bubble.alerte{background:#fef2f2;border:1.5px solid #fca5a5;color:#7f1d1d;}
.msg-time{font-size:.65rem;color:var(--muted);text-align:center;margin-top:2px;}
.typing{display:none;align-self:flex-start;align-items:flex-end;gap:8px;}
.typing.show{display:flex;}
.dots{display:flex;gap:3px;padding:10px 14px;background:white;border-radius:18px;border:1px solid rgba(0,0,0,.08);border-bottom-left-radius:4px;}
.dots span{width:6px;height:6px;border-radius:50%;background:var(--muted);animation:bounce .8s ease-in-out infinite;}
.dots span:nth-child(2){animation-delay:.15s;}
.dots span:nth-child(3){animation-delay:.3s;}
@keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-5px)}}
.input-bar{display:flex;gap:10px;align-items:flex-end;flex-shrink:0;background:white;border:1.5px solid #e0e8dc;border-radius:20px;padding:8px 8px 8px 16px;}
.input-bar:focus-within{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.08);}
.msg-textarea{flex:1;border:none;outline:none;resize:none;font-family:'DM Sans',sans-serif;font-size:.9rem;color:var(--dark);background:transparent;max-height:100px;overflow-y:auto;line-height:1.5;}
.msg-textarea::placeholder{color:#aaa;}
.send-btn{width:38px;height:38px;background:var(--forest);color:white;border:none;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:1rem;flex-shrink:0;transition:all .25s;}
.send-btn:hover{background:var(--sage);transform:scale(1.05);}
.send-btn:disabled{opacity:.4;cursor:not-allowed;transform:none;}
.input-hint{font-size:.7rem;color:var(--muted);text-align:right;margin-top:4px;}
</style>
</head>
<body>

<nav class="navbar">
    <a href="/" class="brand">🌿 Jokko<span>Santé</span></a>
    <a href="/dashboard" class="back-btn">← Mon espace</a>
</nav>

<div class="chat-container">

    <div class="chat-header">
        <h2>🤝 Assistant Jokko Santé</h2>
        <p>Confidentiel · Disponible 24h/24 · Urgence : <strong>116</strong></p>
    </div>

    {{-- Alerte dépression — uniquement si détectée --}}
    @if($alerteDepression && $dernierTest)
    <div class="alerte-box">
        🚨 <strong>Signes de dépression détectés</strong> — Score PHQ-9 : {{ $dernierTest->score_total }}/27
        ({{ ucfirst(str_replace('_', ' ', $dernierTest->niveau)) }}).
        Notre équipe a été alertée. Je suis là pour vous. 💚
    </div>
    @endif

    <div class="messages-zone" id="messagesZone">

        <div class="msg bot">
            <div class="avatar bot">🌿</div>
            <div>
                <div class="bubble bot">
                    Bonjour <strong>{{ Auth::user()->name }}</strong> 👋<br>
                    Je suis l'assistant de <strong>Jokko Santé</strong>. Je suis là pour vous écouter, vous conseiller et vous orienter — en toute confidentialité.<br><br>
                    Comment puis-je vous aider aujourd'hui ?
                </div>
                <div class="msg-time">{{ now()->format('H:i') }}</div>
            </div>
        </div>

        <div class="typing" id="typing">
            <div class="avatar bot">🌿</div>
            <div class="dots"><span></span><span></span><span></span></div>
        </div>

    </div>

    <div class="input-bar">
        <textarea class="msg-textarea" id="msgInput"
                  placeholder="Écrivez votre message..."
                  rows="1"
                  onkeydown="handleKey(event)"
                  oninput="autoResize(this)"></textarea>
        <button class="send-btn" id="sendBtn" onclick="sendMessage()" title="Envoyer">➤</button>
    </div>
    <div class="input-hint">Entrée pour envoyer · Shift+Entrée pour nouvelle ligne</div>

</div>

<script>
const zone     = document.getElementById('messagesZone');
const input    = document.getElementById('msgInput');
const sendBtn  = document.getElementById('sendBtn');
const typing   = document.getElementById('typing');
const csrf     = document.querySelector('meta[name="csrf-token"]').content;
const chatUrl  = '{{ route("assistant.chat") }}';
let   convHistory = [];

function scrollDown() {
    zone.scrollTop = zone.scrollHeight;
}

function nowTime() {
    return new Date().toLocaleTimeString('fr-FR', {hour:'2-digit', minute:'2-digit'});
}

function addMessage(text, role) {
    const isBot    = role === 'assistant';
    const isAlerte = text.includes('URGENCE ABSOLUE') || text.includes('⚠️ URGENCE');

    const wrap = document.createElement('div');
    wrap.className = `msg ${isBot ? 'bot' : 'user'}`;

    const avatarBot  = `<div class="avatar bot">🌿</div>`;
    const avatarUser = `<div class="avatar user">👤</div>`;
    const bubbleCls  = isBot ? (isAlerte ? 'bot alerte' : 'bot') : 'user';

    const formatted = text
        .replace(/\n/g, '<br>')
        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

    wrap.innerHTML = `
        ${isBot ? avatarBot : ''}
        <div>
            <div class="bubble ${bubbleCls}">${formatted}</div>
            <div class="msg-time">${nowTime()}</div>
        </div>
        ${!isBot ? avatarUser : ''}
    `;

    zone.insertBefore(wrap, typing);
    scrollDown();
}

function showTyping(show) {
    typing.classList.toggle('show', show);
    scrollDown();
}

async function sendMessage() {
    const text = input.value.trim();
    if (!text || sendBtn.disabled) return;

    addMessage(text, 'user');
    convHistory.push({role: 'user', content: text});

    input.value = '';
    input.style.height = 'auto';
    sendBtn.disabled = true;
    showTyping(true);

    try {
        const res  = await fetch(chatUrl, {
            method:  'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf,
            },
            body: JSON.stringify({
                message: text,
                history: convHistory.slice(-12),
            }),
        });

        const data = await res.json();
        showTyping(false);

        const reply = data.success
            ? data.message
            : 'Une erreur est survenue. En cas d\'urgence, appelez le 116.';

        addMessage(reply, 'assistant');
        convHistory.push({role: 'assistant', content: reply});

    } catch(e) {
        showTyping(false);
        addMessage('Service indisponible. Urgence : 116 · 17 · 800 00 19 19', 'assistant');
    }

    sendBtn.disabled = false;
    input.focus();
}

function handleKey(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
    }
}

function autoResize(el) {
    el.style.height = 'auto';
    el.style.height = Math.min(el.scrollHeight, 100) + 'px';
}

// Message automatique UNIQUEMENT si dépression détectée
@if($alerteDepression && $dernierTest)
window.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
        const msg = `{{ Auth::user()->name }}, je vois que votre dernier test PHQ-9 indique un score de {{ $dernierTest->score_total }}/27 — niveau {{ ucfirst(str_replace('_',' ',$dernierTest->niveau)) }}. Je veux que vous sachiez que vous n\'êtes pas seul(e). Notre équipe a été alertée et va vous contacter. Je suis là pour vous accompagner. Comment vous sentez-vous en ce moment ?`;
        addMessage(msg, 'assistant');
        convHistory.push({role: 'assistant', content: msg});
    }, 800);
});
@endif

scrollDown();
</script>
</body>
</html>