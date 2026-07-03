<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Nouveau Signalement — Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;1,300&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;--cream:#F5F9F4;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:var(--cream);}
.navbar{background:var(--forest);padding:16px 0;position:sticky;top:0;z-index:100;}
.navbar-brand{font-family:'Fraunces',serif;font-size:1.5rem;font-weight:600;color:white;text-decoration:none;}
.navbar-brand span{color:var(--light);}
.btn-nav{background:var(--light);color:var(--forest);border:none;border-radius:50px;padding:8px 20px;font-size:.84rem;font-weight:700;text-decoration:none;}
.hero{background:var(--forest);padding:48px 0;text-align:center;}
.hero h1{font-family:'Fraunces',serif;font-size:2.2rem;font-weight:300;color:white;letter-spacing:-.03em;margin-bottom:10px;}
.hero h1 em{font-style:italic;color:var(--light);}
.hero p{color:rgba(255,255,255,.6);font-size:.95rem;max-width:500px;margin:0 auto;}
.main{max-width:760px;margin:0 auto;padding:48px 20px;}
.urgence-box{background:#fef2f2;border:2px solid #fca5a5;border-radius:16px;padding:18px 22px;margin-bottom:28px;display:flex;align-items:flex-start;gap:12px;}
.urgence-box p{font-size:.85rem;color:#7f1d1d;margin:0;line-height:1.6;}
.form-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.07);padding:36px;margin-bottom:24px;}
.form-card h3{font-family:'Fraunces',serif;font-size:1.1rem;font-weight:600;color:var(--dark);margin-bottom:20px;}
label{display:block;font-size:.8rem;font-weight:600;color:var(--dark);margin-bottom:8px;letter-spacing:.02em;}
input[type=text],textarea,select{width:100%;padding:12px 16px;border:1.5px solid #e0e8dc;border-radius:12px;font-size:.9rem;font-family:'DM Sans',sans-serif;color:var(--dark);background:#fafaf8;outline:none;transition:border-color .25s;}
input:focus,textarea:focus,select:focus{border-color:var(--sage);box-shadow:0 0 0 3px rgba(45,90,39,.1);background:white;}
textarea{resize:vertical;min-height:140px;}
.field{margin-bottom:20px;}
.row2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}

/* URGENCE BUTTONS */
.urgence-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-top:8px;}
.urgence-item input{display:none;}
.urgence-label{display:flex;flex-direction:column;align-items:center;gap:6px;padding:16px 10px;border-radius:14px;border:1.5px solid #e0e8dc;cursor:pointer;transition:all .25s;background:#fafaf8;text-align:center;}
.urgence-label:hover{border-color:var(--sage);}
.urgence-item input:checked + .urgence-label.faible{border-color:#16a34a;background:#f0fdf4;}
.urgence-item input:checked + .urgence-label.moyenne{border-color:#ca8a04;background:#fefce8;}
.urgence-item input:checked + .urgence-label.elevee{border-color:#dc2626;background:#fef2f2;}
.urgence-emoji{font-size:1.8rem;}
.urgence-text{font-size:.78rem;font-weight:700;color:var(--muted);}

/* GPS */
.gps-card{background:var(--light);border-radius:14px;padding:18px 20px;border:1px solid rgba(26,61,22,.15);}
.btn-gps{display:inline-flex;align-items:center;gap:8px;background:var(--forest);color:white;border:none;border-radius:10px;padding:10px 20px;font-size:.84rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;}
.btn-gps:hover{background:var(--sage);}
.btn-gps.loading{opacity:.7;cursor:wait;}
.gps-result{margin-top:12px;font-size:.82rem;color:var(--sage);font-weight:600;display:none;}
.gps-result.visible{display:block;}

/* PHOTO */
.photo-zone{border:2px dashed #e0e8dc;border-radius:14px;padding:24px;text-align:center;cursor:pointer;transition:all .3s;background:#fafaf8;}
.photo-zone:hover{border-color:var(--sage);background:var(--light);}
.photo-zone input{display:none;}
.photo-preview{max-width:200px;border-radius:10px;margin-top:12px;display:none;}

.btn-submit{width:100%;background:var(--forest);color:white;border:none;border-radius:50px;padding:16px;font-size:1rem;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .3s;box-shadow:0 6px 20px rgba(26,61,22,.25);}
.btn-submit:hover{background:var(--sage);transform:translateY(-2px);}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
.alert-err{background:#fef2f2;border:1px solid #fca5a5;color:#dc2626;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}
</style>
</head>
<body>

<nav class="navbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="/" class="navbar-brand">🌿 Jokko<span>Santé</span></a>
        <a href="/dashboard" class="btn-nav">← Mon espace</a>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Faire un <em>signalement</em></h1>
        <p>Signalez une situation de danger, de violence ou de détresse. Votre signalement est confidentiel et traité en priorité.</p>
    </div>
</div>

<div class="main">

    @if($errors->any())
        <div class="alert-err">
            @foreach($errors->all() as $e)<div>❌ {{ $e }}</div>@endforeach
        </div>
    @endif

    {{-- ALERTE URGENCE --}}
    <div class="urgence-box">
        <span style="font-size:1.5rem;flex-shrink:0;">⚠️</span>
        <p><strong>En cas de danger immédiat :</strong> Appelez le <strong>17 (Police)</strong> ou le <strong>116 (SAMU Social)</strong> MAINTENANT. Pour les femmes en danger : <strong>800 00 19 19</strong> (SOS Femmes, gratuit).</p>
    </div>

    <form method="POST" action="{{ route('signalement.store') }}" enctype="multipart/form-data">
        @csrf

        {{-- DESCRIPTION --}}
        <div class="form-card">
            <h3>📝 Décrivez la situation</h3>
            <div class="field">
                <label>Description de la situation</label>
                <textarea name="description" placeholder="Décrivez ce que vous observez ou vivez, le plus précisément possible. Votre témoignage est confidentiel." required>{{ old('description') }}</textarea>
            </div>
            <div class="row2">
                <div class="field">
                    <label>Catégorie</label>
                    <select name="categorie" required>
                        <option value="">-- Choisir --</option>
                        <option value="violence"   {{ old('categorie')=='violence'?'selected':'' }}>🔴 Violence</option>
                        <option value="detresse"   {{ old('categorie')=='detresse'?'selected':'' }}>💙 Détresse psychologique</option>
                        <option value="danger"     {{ old('categorie')=='danger'?'selected':'' }}>⚠️ Danger immédiat</option>
                        <option value="insecurite" {{ old('categorie')=='insecurite'?'selected':'' }}>🔒 Insécurité</option>
                        <option value="autre"      {{ old('categorie')=='autre'?'selected':'' }}>📌 Autre</option>
                    </select>
                </div>
                <div class="field">
                    <label>Niveau d'urgence</label>
                    <div class="urgence-grid">
                        <div class="urgence-item">
                            <input type="radio" name="urgence" value="faible" id="u-faible" {{ old('urgence')=='faible'?'checked':'' }}>
                            <label for="u-faible" class="urgence-label faible">
                                <span class="urgence-emoji">🟢</span>
                                <span class="urgence-text">Faible</span>
                            </label>
                        </div>
                        <div class="urgence-item">
                            <input type="radio" name="urgence" value="moyenne" id="u-moyenne" {{ old('urgence','moyenne')=='moyenne'?'checked':'' }}>
                            <label for="u-moyenne" class="urgence-label moyenne">
                                <span class="urgence-emoji">🟡</span>
                                <span class="urgence-text">Moyenne</span>
                            </label>
                        </div>
                        <div class="urgence-item">
                            <input type="radio" name="urgence" value="elevee" id="u-elevee" {{ old('urgence')=='elevee'?'checked':'' }}>
                            <label for="u-elevee" class="urgence-label elevee">
                                <span class="urgence-emoji">🔴</span>
                                <span class="urgence-text">Élevée</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- GÉOLOCALISATION --}}
        <div class="form-card">
            <h3>📍 Localisation</h3>
            <div class="gps-card">
                <p style="font-size:.84rem;color:var(--sage);margin-bottom:12px;font-weight:500;">
                    Votre position GPS sera détectée automatiquement pour aider les équipes à intervenir rapidement.
                </p>
                <button type="button" class="btn-gps" id="btnGps" onclick="getPosition()">
                    📍 Obtenir ma position
                </button>
                <div class="gps-result" id="gpsResult">
                    ✅ Position détectée avec succès
                </div>
            </div>
            <input type="hidden" name="latitude"  id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <div class="field" style="margin-top:14px;">
                <label>Adresse ou description du lieu <span style="color:var(--muted);font-weight:400">(optionnel)</span></label>
                <input type="text" name="adresse" value="{{ old('adresse') }}" placeholder="Ex: Quartier Médina, près du marché central...">
            </div>
        </div>

        {{-- PHOTO --}}
        <div class="form-card">
            <h3>📷 Joindre une photo <span style="font-size:.84rem;font-weight:400;color:var(--muted)">(optionnel)</span></h3>
            <p style="font-size:.82rem;color:var(--muted);margin-bottom:16px;">Une photo peut aider les équipes à mieux évaluer la situation. Ne prenez des photos que si c'est sécuritaire pour vous.</p>
            <div class="photo-zone" onclick="document.getElementById('photoInput').click()">
                <div style="font-size:2.5rem;margin-bottom:10px;">📷</div>
                <p style="font-size:.84rem;color:var(--muted);margin:0;">Cliquez pour ajouter une photo (max 2 Mo)</p>
                <input type="file" name="photo" id="photoInput" accept="image/*" onchange="previewPhoto(this)">
                <img id="photoPreview" class="photo-preview" alt="Aperçu">
            </div>
        </div>

        <button type="submit" class="btn-submit">📨 Envoyer le signalement</button>

    </form>

</div>

<footer style="background:var(--dark);padding:36px 0;border-top:1px solid rgba(232,245,228,.1);margin-top:40px;">
    <div class="container text-center">
        <p style="font-family:'Fraunces',serif;font-size:1.3rem;color:white;font-weight:600;margin-bottom:8px;">🌿 Jokko<span style="color:var(--light);">Santé</span></p>
        <p style="color:rgba(255,255,255,.3);font-size:.8rem;">© {{ date('Y') }} Jokko Santé — Urgence : 116 · 17 · 800 00 19 19</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function getPosition() {
    const btn = document.getElementById('btnGps');
    btn.classList.add('loading');
    btn.textContent = '⏳ Détection en cours...';

    if (!navigator.geolocation) {
        alert('La géolocalisation n\'est pas disponible sur votre navigateur.');
        btn.classList.remove('loading');
        btn.textContent = '📍 Obtenir ma position';
        return;
    }

    navigator.geolocation.getCurrentPosition(
        (pos) => {
            document.getElementById('latitude').value  = pos.coords.latitude;
            document.getElementById('longitude').value = pos.coords.longitude;
            document.getElementById('gpsResult').classList.add('visible');
            btn.textContent = '✅ Position obtenue';
            btn.style.background = '#16a34a';
        },
        (err) => {
            btn.classList.remove('loading');
            btn.textContent = '📍 Réessayer';
            alert('Impossible d\'obtenir votre position. Veuillez décrire le lieu manuellement.');
        }
    );
}

function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const preview = document.getElementById('photoPreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>