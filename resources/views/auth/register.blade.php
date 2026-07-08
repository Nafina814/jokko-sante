<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Inscription — Jokko Santé</title>

<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;0,700;1,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

<style>
:root{
  --forest:#0f3b1b;
  --sage:#135324;
  --mint:#2a6b33;
  --leaf:#76c043;
  --light:#E8F5E4;
  --cream:#F8FBF6;
  --muted:#5a7a55;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}

body{
  font-family:'DM Sans',sans-serif;
  background: linear-gradient(135deg, #f8fbf6 0%, #edf4eb 100%);
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:20px;
}
.container{
  max-width:1150px;
  width:100%;
  background:white;
  border-radius:28px;
  box-shadow:0 20px 60px rgba(26,61,22,.12);
  overflow:hidden;
  display:grid;
  grid-template-columns:1fr 1.1fr;
  min-height: 700px;           /* Hauteur suffisante */
  align-items: stretch;        /* Important : les 2 colonnes prennent toute la hauteur */
}

/* ==================== PARTIE GAUCHE - Image pleine surface ==================== */
.left{
  background: 
    linear-gradient(rgba(15,59,27,0.65), rgba(15,59,27,0.75)),
    url('/images/mon-image.png') center/cover no-repeat;
  background-size: cover;
  background-position: center;
  padding:80px 50px;
  display:flex;
  flex-direction:column;
  justify-content:center;
  color:white;
  position:relative;
  height: 100%;                /* Prend toute la hauteur disponible */
}
.left h1{
  font-family:'Fraunces',serif;
  font-size:2.6rem;
  font-weight:600;
  line-height:1.1;
  margin-bottom:20px;
}
.left p{
  font-size:1.15rem;
  line-height:1.55;
  opacity:0.95;
  max-width:420px;
}

/* ==================== PARTIE DROITE ==================== */
.right{
  padding:60px 55px;
  background:white;
}
.page-head h2{
  font-family:'Fraunces',serif;
  font-size:1.85rem;
  color:var(--forest);
  margin-bottom:8px;
}
.page-head p{
  color:var(--muted);
  font-size:0.95rem;
}

/* Rôles */
.role-grid{
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:14px;
  margin:32px 0;
}
.role-item input{display:none;}
.role-card{
  border:2px solid #e5ede0;
  border-radius:20px;
  padding:18px 14px;
  text-align:center;
  cursor:pointer;
  transition:all .3s ease;
  background:white;
}
.role-card:hover{
  border-color:var(--leaf);
  transform:translateY(-4px);
  box-shadow:0 12px 30px rgba(118,192,67,.15);
}
.role-item input:checked + .role-card{
  border-color:var(--forest);
  background:#f0f9ed;
}
.role-icon{
  width:64px;height:64px;
  border-radius:16px;
  margin:0 auto 12px;
  display:flex;
  align-items:center;
  justify-content:center;
}
.role-icon svg{width:32px;height:32px;}
.role-name{
  font-family:'Fraunces',serif;
  font-weight:600;
  color:#1f3a1c;
}
.role-desc{
  font-size:0.8rem;
  color:#5a7a55;
}

/* Formulaire */
.field{margin-bottom:18px;}
label{
  display:block;
  font-weight:600;
  color:#2a4a28;
  margin-bottom:6px;
  font-size:0.9rem;
}
.req{color:#e04a4a;}
input[type=text],input[type=email],input[type=password],input[type=tel],select,textarea{
  width:100%;
  padding:14px 16px;
  border:1.5px solid #d1e0c8;
  border-radius:14px;
  font-size:0.95rem;
}
input:focus,select:focus,textarea:focus{
  border-color:var(--leaf);
  outline:none;
  box-shadow:0 0 0 4px rgba(118,192,67,.12);
}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
.btn-submit{
  width:100%;
  background:linear-gradient(135deg,var(--forest),var(--mint));
  color:white;
  border:none;
  border-radius:16px;
  padding:16px;
  font-size:1.05rem;
  font-weight:700;
  margin-top:20px;
  cursor:pointer;
  box-shadow:0 10px 25px rgba(15,59,27,.25);
}
.btn-submit:hover{
  transform:translateY(-3px);
  box-shadow:0 15px 35px rgba(15,59,27,.3);
}
.alert-err{
  background:#fef2f2;
  border:1px solid #fca5a5;
  color:#dc2626;
  padding:14px;
  border-radius:12px;
  margin-bottom:20px;
}
@media(max-width:960px){
  .container{grid-template-columns:1fr; min-height: auto;}
  .left{
    min-height: 500px;
    background-size: cover;
  }
  .right{padding:50px 30px;}
}
</style>
</head>

<body>
<div class="container">
  <div class="left">
    <h1>Bienvenue →</h1>
    <p>Rejoignez la communauté Jokko Santé — une plateforme gratuite et confidentielle dédiée à votre bien-être mental.</p>
  </div>

  <div class="right">
    <div class="page-head">
      <h2>Créer mon compte</h2>
      <p>Choisissez votre profil pour commencer</p>
    </div>

    @if($errors->any())
    <div class="alert-err">
      @foreach($errors->all() as $e)<div>❌ {{ $e }}</div>@endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}" id="regForm">
      @csrf

      <div class="role-grid">
        <div class="role-item">
          <input type="radio" name="role" value="utilisateur" id="r-user"
            {{ old('role','utilisateur')==='utilisateur'?'checked':'' }}
            onchange="switchRole('utilisateur')">
          <label for="r-user" class="role-card">
            <div class="role-icon" style="background:#e0f0d9;">
              <svg viewBox="0 0 24 24" fill="none" stroke="#0f3b1b" stroke-width="2">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
              </svg>
            </div>
            <div class="role-name">Utilisateur</div>
            <div class="role-desc">Je cherche du soutien</div>
          </label>
        </div>

        <div class="role-item">
          <input type="radio" name="role" value="pair_aidant" id="r-pair"
            {{ old('role')==='pair_aidant'?'checked':'' }}
            onchange="switchRole('pair_aidant')">
          <label for="r-pair" class="role-card">
            <div class="role-icon" style="background:#e0f0ff;">
              <svg viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
              </svg>
            </div>
            <div class="role-name">Pair-aidant</div>
            <div class="role-desc">Badienou Gokh / Bénévole</div>
          </label>
        </div>

        <div class="role-item">
          <input type="radio" name="role" value="psychologue" id="r-psycho"
            {{ old('role')==='psychologue'?'checked':'' }}
            onchange="switchRole('psychologue')">
          <label for="r-psycho" class="role-card">
            <div class="role-icon" style="background:#f3e8ff;">
              <svg viewBox="0 0 24 24" fill="none" stroke="#7c3aed" stroke-width="2">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
              </svg>
            </div>
            <div class="role-name">Psychologue</div>
            <div class="role-desc">Professionnel certifié</div>
          </label>
        </div>
      </div>

      <div class="field">
        <label>Nom complet <span class="req">*</span></label>
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex : Fatou Diallo" required>
      </div>

      <div class="row2">
        <div class="field">
          <label>Adresse email <span class="req">*</span></label>
          <input type="email" name="email" value="{{ old('email') }}" placeholder="votre@email.com" required>
        </div>
        <div class="field">
          <label>Téléphone</label>
          <input type="tel" name="telephone" value="{{ old('telephone') }}" placeholder="+221 77 XXX XX XX">
        </div>
      </div>

      <div class="row2">
        <div class="field">
          <label>Mot de passe <span class="req">*</span></label>
          <input type="password" name="password" placeholder="Minimum 8 caractères" required>
        </div>
        <div class="field">
          <label>Confirmer <span class="req">*</span></label>
          <input type="password" name="password_confirmation" placeholder="Répétez le mot de passe" required>
        </div>
      </div>

      <div class="field">
        <label>Genre <span class="req">*</span></label>
        <select name="genre" required>
          <option value="">-- Choisir --</option>
          <option value="homme" {{ old('genre')==='homme'?'selected':'' }}>Homme</option>
          <option value="femme" {{ old('genre')==='femme'?'selected':'' }}>Femme</option>
          <option value="autre" {{ old('genre')==='autre'?'selected':'' }}>Autre / Non précisé</option>
        </select>
      </div>

      <div class="role-section" id="sec-psychologue" style="display:none;">
        <div style="background:#eff6ff;border:1px solid #bfdbfe;color:#1e40af;padding:14px;border-radius:12px;margin:20px 0;">
          <strong>Vérification professionnelle obligatoire</strong><br>
          Votre dossier sera examiné sous 24-48h.
        </div>
        <div class="field">
          <label>Numéro d'ordre <span class="req">*</span></label>
          <input type="text" name="numero_ordre" value="{{ old('numero_ordre') }}" placeholder="Ex : PSY-2024-001">
        </div>
        <div class="field">
          <label>Spécialité <span class="req">*</span></label>
          <input type="text" name="specialite" value="{{ old('specialite') }}" placeholder="Ex : Psychologie clinique">
        </div>
        <div class="field">
          <label>Établissement <span class="req">*</span></label>
          <input type="text" name="etablissement" value="{{ old('etablissement') }}" placeholder="Ex : Hôpital Principal de Dakar">
        </div>
      </div>

      <div class="role-section" id="sec-pair_aidant" style="display:none;">
        <div style="background:#f0fdf4;border:1px solid #86efac;color:#14532d;padding:14px;border-radius:12px;margin:20px 0;">
          <strong>Validation de votre engagement requise</strong><br>
          Votre demande sera examinée.
        </div>
        <div class="field">
          <label>Type de pair-aidant <span class="req">*</span></label>
          <select name="type_pair_aidant">
            <option value="">-- Choisir --</option>
            <option value="badienou_gokh" {{ old('type_pair_aidant')==='badienou_gokh'?'selected':'' }}>Badienou Gokh</option>
            <option value="ong" {{ old('type_pair_aidant')==='ong'?'selected':'' }}>ONG</option>
            <option value="benevole" {{ old('type_pair_aidant')==='benevole'?'selected':'' }}>Bénévole</option>
          </select>
        </div>
        <div class="field">
          <label>Organisation <span style="color:#5a7a55;font-weight:400;">(optionnel)</span></label>
          <input type="text" name="organisation" value="{{ old('organisation') }}" placeholder="Ex : Croix-Rouge Sénégal">
        </div>
        <div class="field">
          <label>Motivation <span class="req">*</span></label>
          <textarea name="motivation" rows="4" placeholder="Décrivez votre motivation en au moins 50 caractères...">{{ old('motivation') }}</textarea>
        </div>
      </div>

      <button type="submit" class="btn-submit">
        Créer mon compte
      </button>

      <div style="text-align:center;margin-top:18px;font-size:0.9rem;color:#5a7a55;">
        Déjà un compte ? <a href="/login" style="color:var(--leaf);font-weight:600;">Se connecter</a>
      </div>
    </form>
  </div>
</div>

<script>
function switchRole(role) {
  document.querySelectorAll('.role-section').forEach(s => s.style.display = 'none');
  const section = document.getElementById('sec-' + role);
  if (section) section.style.display = 'block';
}

window.addEventListener('DOMContentLoaded', () => {
  const checked = document.querySelector('input[name="role"]:checked');
  if (checked) switchRole(checked.value);

  if (window.lucide && typeof window.lucide.createIcons === 'function') {
    window.lucide.createIcons();
  }
});
</script>
</body>
</html>