<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Demande soumise — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;}
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F5F9F4;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:24px;}
.card{background:white;border-radius:24px;border:1px solid rgba(0,0,0,.07);padding:52px 48px;max-width:520px;width:100%;text-align:center;box-shadow:0 20px 60px rgba(26,61,22,.08);}
.icon{font-size:4rem;margin-bottom:20px;}
h1{font-family:'Fraunces',serif;font-size:1.8rem;font-weight:300;color:var(--dark);margin-bottom:12px;}
p{color:var(--muted);font-size:.9rem;line-height:1.8;margin-bottom:20px;}
.steps{background:#F5F9F4;border-radius:14px;padding:20px;margin-bottom:28px;text-align:left;}
.step{display:flex;align-items:flex-start;gap:12px;padding:8px 0;border-bottom:1px solid rgba(0,0,0,.05);}
.step:last-child{border-bottom:none;}
.step-num{width:26px;height:26px;border-radius:50%;background:var(--forest);color:white;display:flex;align-items:center;justify-content:center;font-size:.74rem;font-weight:700;flex-shrink:0;margin-top:2px;}
.step-text{font-size:.84rem;color:var(--dark);line-height:1.5;}
.step-text strong{color:var(--forest);}
.btn{display:inline-flex;align-items:center;gap:8px;background:var(--forest);color:white;border:none;border-radius:50px;padding:13px 28px;font-size:.9rem;font-weight:700;text-decoration:none;transition:all .3s;}
.btn:hover{background:var(--sage);color:white;transform:translateY(-2px);}
.urgence{margin-top:20px;font-size:.78rem;color:var(--muted);}
.urgence strong{color:#dc2626;}
</style>
</head>
<body>
<div class="card">
    <div class="icon">⏳</div>
    <h1>Demande soumise avec succès !</h1>
    <p>
        Votre demande a bien été reçue. Notre équipe va examiner votre dossier
        et vous contacter dans les plus brefs délais.
    </p>

    <div class="steps">
        <div class="step">
            <div class="step-num">1</div>
            <div class="step-text"><strong>Dossier reçu</strong> — Votre demande est en cours d'examen par notre équipe.</div>
        </div>
        <div class="step">
            <div class="step-num">2</div>
            <div class="step-text"><strong>Vérification</strong> — Nous vérifions vos informations (24 à 48h ouvrables).</div>
        </div>
        <div class="step">
            <div class="step-num">3</div>
            <div class="step-text"><strong>Notification</strong> — Vous recevrez un email ou SMS de confirmation.</div>
        </div>
        <div class="step">
            <div class="step-num">4</div>
            <div class="step-text"><strong>Accès</strong> — Votre compte sera activé et vous pourrez vous connecter.</div>
        </div>
    </div>

    <a href="/login" class="btn">← Retour à la connexion</a>

    <div class="urgence">
        Besoin d'aide urgente ? Appelez le <strong>116</strong> (SAMU Social)
        ou le <strong>800 00 19 19</strong> (SOS Femmes)
    </div>
</div>
</body>
</html>