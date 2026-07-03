<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Signalements — Pair-aidant Jokko Santé</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css"/>
<style>
:root{--forest:#1A3D16;--sage:#2D5A27;--light:#E8F5E4;--dark:#0f2410;--muted:#6b7568;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'DM Sans',sans-serif;background:#F5F9F4;}
.sidebar{position:fixed;top:0;left:0;width:260px;height:100vh;background:var(--forest);display:flex;flex-direction:column;z-index:100;transition:transform 0.3s ease;}
.sidebar-brand{padding:28px 24px;border-bottom:1px solid rgba(255,255,255,.08);}
.sidebar-brand a{font-family:'Fraunces',serif;font-size:1.4rem;font-weight:600;color:white;text-decoration:none;}
.sidebar-brand a span{color:var(--light);}
.sidebar-brand p{color:rgba(255,255,255,.4);font-size:.75rem;margin-top:4px;}
.sidebar-nav{padding:20px 0;flex:1;overflow-y:auto;}
.nav-section{padding:8px 24px;font-size:.7rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:rgba(255,255,255,.3);margin-top:12px;}
.nav-item a{display:flex;align-items:center;gap:12px;padding:11px 24px;color:rgba(255,255,255,.65);text-decoration:none;font-size:.88rem;font-weight:500;transition:all .25s;}
.nav-item a:hover{background:rgba(255,255,255,.07);color:white;}
.nav-item a.active{background:rgba(255,255,255,.1);color:white;border-right:3px solid var(--light);}
.nav-item a .icon{font-size:1rem;width:20px;text-align:center;}
.sidebar-footer{padding:16px 24px;border-top:1px solid rgba(255,255,255,.08);display:flex;flex-direction:column;gap:4px;}
.sidebar-footer a{display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.5);font-size:.84rem;text-decoration:none;padding:8px 0;transition:color .25s;}
.sidebar-footer a:hover{color:white;}
.main{margin-left:260px;min-height:100vh;transition:margin-left 0.3s ease;}
.topbar{background:white;padding:16px 32px;border-bottom:1px solid rgba(0,0,0,.07);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.hamburger{display:none;background:none;border:none;font-size:1.6rem;color:var(--dark);cursor:pointer;padding:4px;}
.topbar h1{font-family:'Fraunces',serif;font-size:1.3rem;font-weight:600;color:var(--dark);margin:0;}
.avatar{width:38px;height:38px;border-radius:50%;background:var(--forest);display:flex;align-items:center;justify-content:center;color:white;font-size:.82rem;font-weight:700;}
.content{padding:32px;}
.stat-cards{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;}
.stat-card{background:white;border-radius:16px;padding:20px 22px;border:1px solid rgba(0,0,0,.06);border-left:4px solid var(--forest);}
.stat-card .num{font-family:'Fraunces',serif;font-size:2rem;font-weight:600;color:var(--forest);line-height:1;}
.stat-card .lbl{font-size:.78rem;color:var(--muted);margin-top:6px;}
.filter-bar{display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap;}
.filter-btn{border:1.5px solid #e0e8dc;border-radius:50px;padding:7px 18px;font-size:.82rem;font-weight:600;font-family:'DM Sans',sans-serif;background:white;cursor:pointer;color:var(--muted);transition:all .25s;}
.filter-btn:hover,.filter-btn.active{background:var(--forest);color:white;border-color:var(--forest);}
.filter-btn.attente.active{background:#ca8a04;border-color:#ca8a04;}
.filter-btn.pris.active{background:#1d4ed8;border-color:#1d4ed8;}
.filter-btn.traite.active{background:#16a34a;border-color:#16a34a;}
#map{height:500px;border-radius:20px;border:1px solid rgba(0,0,0,.07);margin-bottom:24px;z-index:1;}
.info-banner{background:var(--light);border:1px solid rgba(26,61,22,.15);border-radius:14px;padding:14px 20px;margin-bottom:20px;font-size:.85rem;color:var(--sage);display:flex;align-items:center;gap:10px;}
.table-card{background:white;border-radius:20px;border:1px solid rgba(0,0,0,.06);overflow:hidden;}
.table-header{padding:18px 24px;border-bottom:1px solid rgba(0,0,0,.06);}
.table-header h2{font-family:'Fraunces',serif;font-size:1.05rem;color:var(--dark);margin:0;font-weight:600;}
table{width:100%;border-collapse:collapse;}
thead th{padding:12px 16px;font-size:.74rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--muted);background:#fafaf8;border-bottom:1px solid rgba(0,0,0,.06);text-align:left;}
tbody tr{border-bottom:1px solid rgba(0,0,0,.05);transition:background .2s;}
tbody tr:last-child{border-bottom:none;}
tbody tr:hover{background:#fafaf8;}
tbody td{padding:12px 16px;font-size:.85rem;color:var(--dark);vertical-align:middle;}
.badge-s{padding:4px 10px;border-radius:50px;font-size:.72rem;font-weight:700;}
.s-en_attente{background:#fef3c7;color:#92400e;}
.s-pris_en_charge{background:#dbeafe;color:#1e40af;}
.s-traite{background:#dcfce7;color:#166534;}
.badge-u{padding:3px 8px;border-radius:50px;font-size:.7rem;font-weight:700;}
.u-faible{background:#dcfce7;color:#166534;}
.u-moyenne{background:#fef3c7;color:#92400e;}
.u-elevee{background:#fee2e2;color:#dc2626;}
.photo-thumb{width:44px;height:44px;object-fit:cover;border-radius:8px;cursor:pointer;}
.alert-success{background:#f0faf0;border:1px solid #86efac;color:#166534;border-radius:12px;padding:12px 18px;margin-bottom:20px;font-size:.88rem;}

/* RESPONSIVE HAMBURGER */
@media (max-width: 992px) {
    .hamburger{display:block;}
    .sidebar{transform:translateX(-100%);}
    .sidebar.active{transform:translateX(0);}
    .main{margin-left:0;}
}
</style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="/">🌿 Jokko<span>Santé</span></a>
        <p>Espace Pair-aidant</p>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <div class="nav-item"><a href="/dashboard"><span class="icon">📊</span> Tableau de bord</a></div>
        
</div>

<div class="main">
    <div class="topbar">
        <div style="display:flex;align-items:center;gap:16px;">
            <button class="hamburger" id="hamburgerBtn">
                <i data-lucide="menu"></i>
            </button>
            <h1>🗺️ Carte des signalements</h1>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:.84rem;color:var(--muted);">{{ Auth::user()->name }}</span>
            <div class="avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
        </div>
    </div>

    <div class="content">

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        {{-- Bannière info --}}
        <div class="info-banner">
            🤝 <span>En tant que pair-aidant, vous pouvez visualiser tous les signalements pour intervenir rapidement auprès des personnes en besoin dans votre communauté. Contactez l'équipe admin si une situation nécessite une intervention urgente.</span>
        </div>

        {{-- STATS --}}
        <div class="stat-cards">
            <div class="stat-card">
                <div class="num">{{ $stats['total'] }}</div>
                <div class="lbl">📋 Total signalements</div>
            </div>
            <div class="stat-card" style="border-left-color:#ca8a04;">
                <div class="num" style="color:#ca8a04;">{{ $stats['en_attente'] }}</div>
                <div class="lbl">🟡 En attente</div>
            </div>
            <div class="stat-card" style="border-left-color:#1d4ed8;">
                <div class="num" style="color:#1d4ed8;">{{ $stats['pris_en_charge'] }}</div>
                <div class="lbl">🔵 Pris en charge</div>
            </div>
            <div class="stat-card" style="border-left-color:#16a34a;">
                <div class="num" style="color:#16a34a;">{{ $stats['traite'] }}</div>
                <div class="lbl">🟢 Traités</div>
            </div>
        </div>

        {{-- FILTRES --}}
        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterMap('all', this)">🗺️ Tous</button>
            <button class="filter-btn attente" onclick="filterMap('en_attente', this)">🟡 En attente</button>
            <button class="filter-btn pris" onclick="filterMap('pris_en_charge', this)">🔵 Pris en charge</button>
            <button class="filter-btn traite" onclick="filterMap('traite', this)">🟢 Traités</button>
        </div>

        {{-- CARTE --}}
        <div id="map"></div>

        {{-- TABLEAU -- lecture seule --}}
        <div class="table-card">
            <div class="table-header">
                <h2>📋 Liste des signalements ({{ $signalements->count() }})</h2>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Signalé par</th>
                        <th>Description</th>
                        <th>Catégorie</th>
                        <th>Urgence</th>
                        <th>GPS</th>
                        <th>Statut</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($signalements as $sig)
                    <tr>
                        <td>
                            @if($sig->photo)
                                <img src="{{ asset('storage/'.$sig->photo) }}" class="photo-thumb"
                                     onclick="window.open('{{ asset('storage/'.$sig->photo) }}','_blank')">
                            @else
                                <span style="font-size:1.5rem;">📷</span>
                            @endif
                        </td>
                        <td>
                            <p style="font-weight:600;margin:0;font-size:.84rem;">
                                {{ $sig->user->anonyme ? 'Anonyme' : $sig->user->name }}
                            </p>
                        </td>
                        <td style="max-width:200px;">
                            <p style="font-size:.82rem;margin:0;">{{ Str::limit($sig->description, 80) }}</p>
                        </td>
                        <td><span class="badge-s" style="background:var(--light);color:var(--forest);">{{ ucfirst($sig->categorie) }}</span></td>
                        <td><span class="badge-u u-{{ $sig->urgence }}">{{ ucfirst($sig->urgence) }}</span></td>
                        <td>
                            @if($sig->latitude)
                                <a href="https://maps.google.com/?q={{ $sig->latitude }},{{ $sig->longitude }}"
                                   target="_blank" style="color:var(--sage);font-size:.78rem;font-weight:600;text-decoration:none;">
                                    📍 Voir
                                </a>
                            @else
                                <span style="color:var(--muted);font-size:.78rem;">—</span>
                            @endif
                        </td>
                        <td><span class="badge-s s-{{ $sig->statut }}">{{ $sig->libelle_statut }}</span></td>
                        <td style="font-size:.78rem;color:var(--muted);">{{ $sig->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted);">Aucun signalement</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>
// Initialiser Lucide
lucide.createIcons();

// Hamburger menu
const hamburgerBtn = document.getElementById('hamburgerBtn');
const sidebar = document.getElementById('sidebar');

hamburgerBtn.addEventListener('click', () => {
    sidebar.classList.toggle('active');
    
    // Changer l'icône
    const icon = hamburgerBtn.querySelector('i');
    if (sidebar.classList.contains('active')) {
        icon.setAttribute('data-lucide', 'x');
    } else {
        icon.setAttribute('data-lucide', 'menu');
    }
    lucide.createIcons();
});

// Fermer le menu en cliquant en dehors (optionnel)
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

const signalements = @json($signalementsJson);

const map = L.map('map').setView([14.6937, -17.4441], 12);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

const couleurs = {
    'en_attente':     '#ca8a04',
    'pris_en_charge': '#1d4ed8',
    'traite':         '#16a34a',
};
const libelles = {
    'en_attente':     '🟡 En attente',
    'pris_en_charge': '🔵 Pris en charge',
    'traite':         '🟢 Traité',
};

function createIcon(statut) {
    const color = couleurs[statut] || '#ca8a04';
    return L.divIcon({
        html: `<div style="background:${color};width:20px;height:20px;border-radius:50%;border:3px solid white;box-shadow:0 2px 8px rgba(0,0,0,.3);"></div>`,
        className: '',
        iconSize: [20, 20],
        iconAnchor: [10, 10],
    });
}

const markerCluster = L.markerClusterGroup();
const markers = [];

signalements.forEach(sig => {
    if (!sig.latitude || !sig.longitude) return;

    const marker = L.marker([sig.latitude, sig.longitude], {
        icon: createIcon(sig.statut)
    });
    marker.statut = sig.statut;

    const mapsUrl = `https://maps.google.com/?q=${sig.latitude},${sig.longitude}`;
    const photo   = sig.photo
        ? `<img src="${sig.photo}" style="width:100%;border-radius:8px;margin-top:8px;cursor:pointer;" onclick="window.open(this.src,'_blank')">`
        : '';

    marker.bindPopup(`
        <div style="font-family:'DM Sans',sans-serif;font-size:.84rem;min-width:220px;">
            <p style="font-family:'Fraunces',serif;font-size:1rem;font-weight:600;color:#0f2410;margin-bottom:8px;">
                ${sig.categorie.charAt(0).toUpperCase() + sig.categorie.slice(1)}
            </p>
            <span style="display:inline-block;padding:3px 10px;border-radius:50px;font-size:.7rem;font-weight:700;background:${couleurs[sig.statut]}20;color:${couleurs[sig.statut]};margin-bottom:8px;">
                ${libelles[sig.statut]}
            </span>
            <p style="font-size:.82rem;color:#444;margin:8px 0;">${sig.description.substring(0, 120)}...</p>
            <p style="font-size:.76rem;color:#888;margin-bottom:8px;">
                👤 ${sig.user.name} · 📅 ${new Date(sig.created_at).toLocaleDateString('fr-FR')}
            </p>
            ${photo}
            <a href="${mapsUrl}" target="_blank"
               style="display:block;margin-top:10px;text-align:center;background:#1A3D16;color:white;padding:7px;border-radius:8px;font-size:.78rem;font-weight:600;text-decoration:none;">
                🗺️ Google Maps
            </a>
        </div>
    `, { maxWidth: 280 });

    markers.push(marker);
    markerCluster.addLayer(marker);
});

map.addLayer(markerCluster);

function filterMap(statut, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    markerCluster.clearLayers();
    markers.forEach(m => {
        if (statut === 'all' || m.statut === statut) {
            markerCluster.addLayer(m);
        }
    });
}
</script>
</body>
</html>