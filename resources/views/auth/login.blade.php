<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Connexion — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root { --forest:#1A3D16; --sage:#2D5A27; --mint:#3A6B2F; --light:#E8F5E4; --dark:#0f2410; --muted:#6b7568; }
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body { font-family:'DM Sans',sans-serif; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:40px 16px;
  background: linear-gradient(150deg, var(--forest) 0%, #2a5222 50%, var(--dark) 100%); }
.card { background:white; border-radius:28px; padding:52px 48px; width:100%; max-width:440px; box-shadow:0 32px 80px rgba(0,0,0,.32); }
.logo { text-align:center; margin-bottom:36px; }
.logo-mark { width:66px; height:66px; background:linear-gradient(135deg,var(--forest),var(--mint)); border-radius:20px; display:inline-flex; align-items:center; justify-content:center; font-size:1.9rem; box-shadow:0 10px 28px rgba(26,61,22,.38); margin-bottom:16px; }
.logo h2 { font-family:'Fraunces',serif; font-size:1.55rem; font-weight:600; color:var(--dark); letter-spacing:-.02em; margin:0; }
.logo h2 span { color:var(--sage); }
.logo p { color:var(--muted); font-size:.85rem; margin-top:6px; }
label { display:block; font-size:.8rem; font-weight:600; color:var(--dark); margin-bottom:8px; letter-spacing:.03em; }
input[type=email], input[type=password] { width:100%; padding:13px 16px; border:1.5px solid #e0e8dc; border-radius:12px; font-size:.9rem; font-family:'DM Sans',sans-serif; background:#fafaf8; color:#1e2e1a; outline:none; transition:border-color .25s,box-shadow .25s; }
input:focus { border-color:var(--sage); box-shadow:0 0 0 3px rgba(45,90,39,.11); background:white; }
.field { margin-bottom:20px; }
.err { color:#dc2626; font-size:.78rem; margin-top:6px; display:block; }
.check-row { display:flex; align-items:center; gap:8px; margin-bottom:26px; }
.check-row input { accent-color:var(--sage); width:15px; height:15px; }
.check-row label { font-size:.84rem; color:var(--muted); margin:0; }
.btn { width:100%; padding:14px; background:linear-gradient(135deg,var(--forest),var(--mint)); color:white; border:none; border-radius:14px; font-size:.95rem; font-weight:700; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all .3s; box-shadow:0 6px 22px rgba(26,61,22,.33); letter-spacing:.02em; }
.btn:hover { transform:translateY(-2px); box-shadow:0 12px 32px rgba(26,61,22,.44); }
.footer-links { display:flex; justify-content:space-between; align-items:center; margin-top:22px; }
.footer-links a { color:var(--sage); font-size:.84rem; text-decoration:none; font-weight:500; transition:color .2s; }
.footer-links a:hover { color:var(--forest); text-decoration:underline; }
.alert-err { background:#fef2f2; border:1px solid #fca5a5; color:#dc2626; border-radius:10px; padding:12px 16px; margin-bottom:20px; font-size:.85rem; }
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <div class="logo-mark">🌿</div>
    <h2>Jokko<span>Santé</span></h2>
    <p>Connectez-vous à votre espace</p>
  </div>

  @if($errors->any())
    <div class="alert-err">
      @foreach($errors->all() as $error) <div>{{ $error }}</div> @endforeach
    </div>
  @endif

  <form method="POST" action="/login">
    @csrf
    <div class="field">
      <label>Adresse email</label>
      <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required autofocus>
    </div>
    <div class="field">
      <label>Mot de passe</label>
      <input type="password" name="password" placeholder="••••••••" required>
    </div>
    <div class="check-row">
      <input type="checkbox" id="remember" name="remember">
      <label for="remember">Se souvenir de moi</label>
    </div>
    <button type="submit" class="btn">Se connecter →</button>
    <div class="footer-links">
      <a href="/">← Accueil</a>
      <a href="/register">Créer un compte</a>
    </div>
  </form>
</div>
</body>
</html>