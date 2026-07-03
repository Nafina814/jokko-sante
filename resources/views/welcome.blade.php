<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Jokko Santé — Entraide & Santé Mentale</title>

  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,300;0,600;0,700;0,900;1,300&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --forest: #1A3D16;
      --sage:   #2D5A27;
      --mint:   #3A6B2F;
      --leaf:   #6ca45b;
      --light:  #E8F5E4;
      --cream:  #F5F9F4;
      --dark:   #0f2410;
      --muted:  #5a7a55;
      --text:   #1e2e1a;
      --transition: all .4s cubic-bezier(.16,1,.3,1);
    }

    *,*::before,*::after { box-sizing:border-box; margin:0; padding:0; }
    html { scroll-behavior: smooth; }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--cream);
      color: var(--text);
      overflow-x: hidden;
      -webkit-font-smoothing: antialiased;
    }
    a { text-decoration: none; }

    /* ── NAVBAR ── */
    .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 999;
      padding: 18px 0;
      background: transparent !important;
      transition: var(--transition);
    }
    .navbar.scrolled {
      background: rgba(10,28,11,.92) !important;
      backdrop-filter: blur(18px);
      padding: 12px 0;
      box-shadow: 0 8px 32px rgba(0,0,0,.24);
    }
    .navbar-brand {
      font-family: 'Fraunces', serif;
      font-size: 1.7rem;
      font-weight: 700;
      color: white !important;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .brand-icon {
      width: 40px; height: 40px;
      background: var(--light);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem;
    }
    .navbar-brand span { color: var(--light); }
    .nav-links a {
      color: rgba(255,255,255,.82);
      font-size: .9rem;
      font-weight: 500;
      margin-left: 28px;
      transition: .25s;
      position: relative;
    }
    .nav-links a::after {
      content: '';
      position: absolute;
      left: 0; bottom: -5px;
      width: 0; height: 1.5px;
      background: var(--light);
      transition: width .3s;
    }
    .nav-links a:hover { color: white; }
    .nav-links a:hover::after { width: 100%; }
    .btn-nav-outline {
      color: white;
      border: 1.5px solid rgba(255,255,255,.45);
      background: rgba(255,255,255,.06);
      border-radius: 8px;
      padding: 8px 20px;
      font-size: .85rem;
      font-weight: 600;
      transition: var(--transition);
      display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-nav-outline:hover { color: white; background: rgba(255,255,255,.14); border-color: white; }
    .btn-nav-solid {
      color: var(--forest) !important;
      background: var(--light);
      border-radius: 8px;
      padding: 9px 22px;
      font-size: .85rem;
      font-weight: 700;
      transition: var(--transition);
      display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-nav-solid:hover { background: white; transform: translateY(-2px); }

    /* ── HERO ── */
    .hero {
      min-height: 100vh;
      position: relative;
      display: flex;
      align-items: center;
      overflow: hidden;
      background-image: url('/images/hero.jpg');
      background-size: cover;
      background-position: center;
    }
    .hero-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(
        105deg,
        rgba(5,16,6,.92) 0%,
        rgba(10,26,11,.78) 45%,
        rgba(8,20,9,.45) 100%
      );
      z-index: 1;
    }
    .hero .container { position: relative; z-index: 2; }

    /* Badge eyebrow */
    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(232,245,228,.10);
      border: 1px solid rgba(232,245,228,.20);
      color: var(--light);
      font-size: .76rem;
      font-weight: 700;
      letter-spacing: .14em;
      text-transform: uppercase;
      padding: 8px 16px;
      border-radius: 6px;
      margin-bottom: 28px;
    }
    .live-dot {
      width: 7px; height: 7px;
      border-radius: 50%;
      background: #8cffaa;
      box-shadow: 0 0 8px #8cffaa;
      animation: pulse-dot 1.8s ease-in-out infinite;
    }

    /* Titre hero amélioré */
    .hero h1 {
      font-family: 'Fraunces', serif;
      font-size: clamp(2.6rem, 5.2vw, 4.6rem);
      font-weight: 300;
      line-height: 1.08;
      letter-spacing: -.04em;
      color: white;
      margin-bottom: 20px;
    }
    .hero h1 strong {
      font-weight: 700;
      color: white;
    }
    .hero h1 em {
      font-style: italic;
      color: var(--light);
      font-weight: 300;
    }

    /* Sous-titre */
    .hero-sub {
      font-size: .98rem;
      color: rgba(255,255,255,.72);
      line-height: 1.9;
      margin-bottom: 32px;
      max-width: 480px;
      font-weight: 400;
    }
    .hero-sub strong { color: rgba(255,255,255,.95); font-weight: 600; }

    /* Barre d'action */
    .hero-action-bar {
      display: flex;
      align-items: center;
      background: white;
      border-radius: 12px;
      padding: 7px 7px 7px 18px;
      max-width: 520px;
      gap: 10px;
      box-shadow: 0 20px 56px rgba(0,0,0,.30);
      margin-bottom: 40px;
    }
    .bar-text {
      flex: 1;
      font-size: .88rem;
      color: var(--muted);
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .bar-divider { width: 1px; height: 26px; background: rgba(0,0,0,.08); flex-shrink: 0; }
    .bar-select {
      border: none;
      outline: none;
      font-family: 'DM Sans', sans-serif;
      font-size: .85rem;
      font-weight: 600;
      color: var(--dark);
      background: transparent;
      padding: 4px 6px;
      cursor: pointer;
    }
    .btn-bar {
      background: var(--forest);
      color: white;
      border: none;
      border-radius: 9px;
      padding: 11px 22px;
      font-size: .88rem;
      font-weight: 700;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: var(--transition);
      white-space: nowrap;
      text-decoration: none;
    }
    .btn-bar:hover { background: var(--sage); color: white; transform: translateY(-2px); }

    /* Stats hero */
    .hero-stats {
      display: flex;
      align-items: center;
      gap: 28px;
      flex-wrap: wrap;
    }
    .hero-stat {
      display: flex;
      align-items: center;
      gap: 10px;
      color: white;
    }
    .hero-stat-icon {
      width: 34px; height: 34px;
      border-radius: 8px;
      background: rgba(232,245,228,.10);
      border: 1px solid rgba(232,245,228,.16);
      display: flex; align-items: center; justify-content: center;
      font-size: .95rem;
      color: var(--light);
      flex-shrink: 0;
    }
    .hero-stat strong {
      display: block;
      font-family: 'Fraunces', serif;
      font-size: 1.2rem;
      font-weight: 700;
      line-height: 1;
      color: white;
    }
    .hero-stat span {
      font-size: .72rem;
      color: rgba(255,255,255,.55);
      line-height: 1.3;
    }
    .hero-stat-sep {
      width: 1px;
      height: 30px;
      background: rgba(255,255,255,.12);
    }

    /* ── STATS BAND ── */
    .stats-band { background: white; border-bottom: 1px solid rgba(0,0,0,.06); }
    .stat-item {
      padding: 36px 24px; text-align: center;
      border-right: 1px solid rgba(0,0,0,.06); position: relative;
    }
    .stat-item:last-child { border-right: none; }
    .stat-item::after {
      content: ''; position: absolute; left: 50%; bottom: 0;
      width: 0; height: 3px;
      background: linear-gradient(90deg, var(--forest), var(--leaf));
      transform: translateX(-50%); transition: width .35s ease;
    }
    .stat-item:hover::after { width: 60%; }
    .stat-num {
      font-family: 'Fraunces', serif;
      font-size: 2.6rem; font-weight: 700;
      color: var(--forest); letter-spacing: -.04em; line-height: 1;
    }
    .stat-label { margin-top: 8px; font-size: .83rem; color: var(--muted); line-height: 1.5; }

    /* ── SECTIONS ── */
    section { position: relative; overflow: hidden; }
    .section-services  { padding: 110px 0; background: var(--cream); }
    .section-why       { padding: 0; background: var(--dark); }
    .section-audiences { padding: 110px 0; background: white; }
    .section-mission   { padding: 110px 0; background: var(--cream); }

    .eyebrow {
      display: inline-block; font-size: .74rem; font-weight: 700;
      letter-spacing: .16em; text-transform: uppercase;
      color: var(--sage); margin-bottom: 14px;
      padding-left: 18px; position: relative;
    }
    .eyebrow::before {
      content: ''; position: absolute; left: 0; top: 50%;
      width: 10px; height: 10px; border-radius: 50%;
      background: linear-gradient(135deg, var(--mint), var(--leaf));
      transform: translateY(-50%);
    }
    .section-title {
      font-family: 'Fraunces', serif;
      font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 300;
      line-height: 1.12; letter-spacing: -.035em; color: var(--dark);
    }

    /* ── SERVICES ── */
    .service-card {
      height: 100%; background: white;
      border: 1px solid rgba(26,61,22,.08); border-radius: 22px;
      padding: 32px 28px; position: relative; overflow: hidden;
      transition: var(--transition); box-shadow: 0 6px 20px rgba(26,61,22,.04);
    }
    .service-card::after {
      content: ''; position: absolute; left: 0; bottom: 0; right: 0; height: 4px;
      background: linear-gradient(90deg, var(--forest), var(--leaf));
      transform: scaleX(0); transform-origin: left; transition: transform .35s ease;
    }
    .service-card:hover { transform: translateY(-10px); box-shadow: 0 24px 56px rgba(26,61,22,.12); }
    .service-card:hover::after { transform: scaleX(1); }
    .s-icon {
      width: 62px; height: 62px; border-radius: 18px;
      display: inline-flex; align-items: center; justify-content: center;
      font-size: 1.6rem; margin-bottom: 20px; color: var(--forest);
      background: linear-gradient(145deg, #eef7eb, #e2f1dd); transition: var(--transition);
    }
    .service-card:hover .s-icon { transform: scale(1.08); }
    .service-card h4 { font-family: 'Fraunces', serif; font-size: 1.2rem; font-weight: 600; color: var(--dark); margin-bottom: 10px; }
    .service-card p  { color: var(--muted); font-size: .88rem; line-height: 1.8; }
    .service-link {
      display: inline-flex; align-items: center; gap: 6px;
      color: var(--sage); font-size: .84rem; font-weight: 700;
      margin-top: 20px; transition: .25s;
    }
    .service-link:hover { color: var(--forest); gap: 10px; }

    /* ── WHY ── */
    .why-wrapper {
      display: grid;
      grid-template-columns: 50% 50%;
      min-height: 680px;
    }
    .why-image-col { position: relative; overflow: hidden; }
    .why-image-col img {
      width: 100%; height: 100%;
      object-fit: cover;
      object-position: center top;
      display: block;
    }
    .why-image-col-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(180deg, transparent 50%, rgba(10,28,11,.65) 100%);
    }
    .why-content-col {
      padding: 72px 56px;
      display: flex; flex-direction: column; justify-content: center;
    }
    .why-cards-wrap { display: flex; flex-direction: column; gap: 14px; margin-top: 28px; }
    .why-card {
      background: rgba(255,255,255,.05);
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 16px; padding: 20px;
      display: flex; align-items: flex-start; gap: 16px;
      transition: var(--transition);
    }
    .why-card:hover { background: rgba(58,107,47,.18); transform: translateX(6px); }
    .why-card-icon {
      width: 48px; height: 48px; border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      background: rgba(232,245,228,.08); border: 1px solid rgba(232,245,228,.12);
      color: var(--light); font-size: 1.2rem; flex-shrink: 0;
    }
    .why-card h5 { font-family: 'Fraunces', serif; font-size: .98rem; font-weight: 600; color: white; margin-bottom: 4px; }
    .why-card p  { font-size: .83rem; color: rgba(255,255,255,.58); line-height: 1.65; margin: 0; }

    /* ── AUDIENCES ── */
    .audience-card {
      height: 100%; border-radius: 26px; overflow: hidden;
      border: 1px solid rgba(26,61,22,.08);
      transition: var(--transition);
      box-shadow: 0 10px 28px rgba(26,61,22,.06);
      display: flex; flex-direction: column;
    }
    .audience-card:hover { transform: translateY(-10px); box-shadow: 0 28px 64px rgba(26,61,22,.14); }
    .aud-img-wrap {
      height: 240px; overflow: hidden;
      position: relative; flex-shrink: 0;
    }
    .aud-img-wrap img {
      width: 100%; height: 100%;
      object-fit: cover;
      transition: transform .5s ease;
    }
    .audience-card:hover .aud-img-wrap img { transform: scale(1.06); }
    .aud-img-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(180deg, transparent 40%, rgba(10,28,11,.55) 100%);
    }
    .aud-img-tag {
      position: absolute; bottom: 14px; left: 14px;
      font-size: .72rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase;
      padding: 5px 12px; border-radius: 999px;
      background: var(--light); color: var(--forest);
    }
    .aud-body {
      padding: 24px 28px 28px;
      background: linear-gradient(145deg, #fbfef9, #eef7eb);
      flex: 1; display: flex; flex-direction: column;
    }
    .aud-badge {
      display: inline-flex; align-items: center; gap: 6px;
      font-size: .74rem; font-weight: 700; color: var(--sage);
      background: rgba(58,107,47,.08); border: 1px solid rgba(58,107,47,.10);
      padding: 5px 12px; border-radius: 999px; margin-bottom: 12px; align-self: flex-start;
    }
    .audience-card h3 { font-family: 'Fraunces', serif; font-size: 1.35rem; font-weight: 600; color: var(--dark); margin-bottom: 10px; }
    .audience-card p  { color: var(--muted); font-size: .87rem; line-height: 1.8; margin-bottom: 16px; flex: 1; }
    .aud-list { list-style: none; padding: 0; margin-bottom: 20px; }
    .aud-list li {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 0; border-bottom: 1px solid rgba(26,61,22,.07);
      font-size: .85rem; color: var(--text);
    }
    .aud-list li i { color: var(--sage); }
    .aud-btn {
      display: inline-flex; align-items: center; gap: 8px;
      padding: 11px 22px; border-radius: 999px;
      font-size: .88rem; font-weight: 700; color: white;
      background: linear-gradient(135deg, var(--sage), var(--mint));
      box-shadow: 0 10px 22px rgba(45,90,39,.22);
      transition: var(--transition); align-self: flex-start;
    }
    .aud-btn:hover { color: white; transform: translateY(-3px); }

    /* ── MISSION ── */
    .mission-visual {
      position: relative; width: 100%; max-width: 400px;
      height: 380px; display: flex; align-items: center; justify-content: center;
    }
    .m-ring { position: absolute; border-radius: 50%; }
    .m-ring-1 { width: 320px; height: 320px; border: 1.5px dashed rgba(45,90,39,.20); }
    .m-ring-2 { width: 210px; height: 210px; border: 1.5px solid rgba(45,90,39,.12); }
    .m-core {
      width: 140px; height: 140px; border-radius: 50%;
      display: flex; flex-direction: column; align-items: center; justify-content: center;
      background: linear-gradient(145deg, var(--forest), var(--mint));
      box-shadow: 0 16px 44px rgba(26,61,22,.32); z-index: 3;
    }
    .m-core-text { margin-top: 4px; text-align: center; font-family: 'Fraunces', serif; font-size: .74rem; line-height: 1.3; color: rgba(255,255,255,.80); }
    .mission-vals { display: flex; flex-direction: column; gap: 12px; margin-top: 24px; }
    .m-val {
      display: flex; align-items: flex-start; gap: 14px;
      padding: 16px 18px; background: white;
      border: 1px solid rgba(26,61,22,.06); border-radius: 16px;
      transition: var(--transition); box-shadow: 0 8px 22px rgba(26,61,22,.04);
    }
    .m-val:hover { transform: translateX(8px); }
    .m-dot { width: 10px; height: 10px; border-radius: 50%; margin-top: 5px; flex-shrink: 0; }
    .m-val strong { display: block; font-size: .9rem; font-weight: 700; color: var(--dark); margin-bottom: 3px; }
    .m-val span { font-size: .82rem; color: var(--muted); line-height: 1.6; }

    /* ── CTA ── */
    .section-cta {
      padding: 100px 0; text-align: center;
      background: linear-gradient(135deg, var(--forest) 0%, var(--mint) 100%);
      position: relative; overflow: hidden;
    }
    .section-cta::before {
      content: ''; position: absolute; width: 600px; height: 600px;
      border-radius: 50%; top: -250px; left: 50%; transform: translateX(-50%);
      border: 1px solid rgba(255,255,255,.07); pointer-events: none;
    }
    .section-cta h2 { font-family: 'Fraunces', serif; font-size: clamp(2rem,4vw,3rem); font-weight: 300; letter-spacing: -.03em; color: white; margin-bottom: 16px; position: relative; z-index: 1; }
    .section-cta p { max-width: 540px; margin: 0 auto 36px; color: rgba(255,255,255,.76); font-size: .98rem; line-height: 1.8; position: relative; z-index: 1; }
    .btn-cta {
      display: inline-flex; align-items: center; gap: 10px;
      padding: 16px 38px; border-radius: 10px;
      background: white; color: var(--forest);
      font-size: 1rem; font-weight: 800;
      box-shadow: 0 14px 36px rgba(0,0,0,.18);
      transition: var(--transition); position: relative; z-index: 1;
    }
    .btn-cta:hover { color: var(--forest); transform: translateY(-4px); }

    /* ── FOOTER ── */
    footer { background: var(--dark); padding: 44px 0 24px; border-top: 1px solid rgba(232,245,228,.08); }
    .footer-brand { font-family: 'Fraunces', serif; font-size: 1.5rem; font-weight: 600; color: white; }
    .footer-brand span { color: var(--light); }
    .footer-urgence {
      display: inline-flex; align-items: center; gap: 8px;
      background: rgba(220,38,38,.12); border: 1px solid rgba(220,38,38,.2);
      border-radius: 8px; padding: 8px 14px;
      font-size: .78rem; font-weight: 700; color: #fca5a5;
      margin-top: 10px;
    }
    footer p { color: rgba(255,255,255,.4); font-size: .82rem; margin-top: 8px; }
    .f-divider { border-top: 1px solid rgba(255,255,255,.08); margin: 24px 0; }
    .f-copy { color: rgba(255,255,255,.26) !important; font-size: .76rem !important; margin: 0 !important; }

    /* ── ANIMATIONS ── */
    @keyframes pulse-dot {
      0%,100% { opacity: 1; transform: scale(1); }
      50% { opacity: .4; transform: scale(1.55); }
    }
    .fade-up, .fade-scale { opacity: 0; }
    @keyframes fadeUp   { from { opacity:0; transform:translateY(28px) } to { opacity:1; transform:translateY(0) } }
    @keyframes zoomSoft { from { opacity:0; transform:scale(.97) } to { opacity:1; transform:scale(1) } }
    .fade-up.visible    { animation: fadeUp .8s cubic-bezier(.16,1,.3,1) forwards; }
    .fade-scale.visible { animation: zoomSoft .8s cubic-bezier(.16,1,.3,1) forwards; }
    .delay-1 { animation-delay: .12s !important; }
    .delay-2 { animation-delay: .24s !important; }
    .delay-3 { animation-delay: .36s !important; }

    /* ── RESPONSIVE ── */
    @media(max-width:991px) {
      .why-wrapper { grid-template-columns: 1fr; }
      .why-image-col { min-height: 340px; }
      .why-content-col { padding: 48px 32px; }
    }
    @media(max-width:768px) {
      .nav-links { display: none !important; }
      .hero h1 { font-size: clamp(2.2rem,7vw,3.2rem); }
      .hero-action-bar { flex-direction: column; padding: 12px; border-radius: 14px; }
      .hero-stats { gap: 16px; }
      .hero-stat-sep { display: none; }
      .stat-item { border-right: none; border-bottom: 1px solid rgba(0,0,0,.06); }
      .stat-item:last-child { border-bottom: none; }
      .section-services,.section-audiences,.section-mission,.section-cta { padding: 80px 0; }
      .aud-img-wrap { height: 200px; }
    }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="container d-flex align-items-center justify-content-between">
    <a class="navbar-brand" href="/">
      <div class="brand-icon">🌿</div>
      <div>Jokko<span>Santé</span></div>
    </a>
    <div class="nav-links d-flex align-items-center">
      <a href="/sensibilisation">Sensibilisation</a>
      <a href="/prevention">Prévention</a>
      <a href="/assistance">Assistance</a>
      <a href="/rendezvous">Rendez-vous</a>
    </div>
    <div class="d-flex gap-2 align-items-center">
      @auth
        <a href="/dashboard" class="btn-nav-solid"><i class="bi bi-grid"></i> Mon espace</a>
      @else
        <a href="/login"    class="btn-nav-outline"><i class="bi bi-box-arrow-in-right"></i> Connexion</a>
        <a href="/register" class="btn-nav-solid"><i class="bi bi-person-plus"></i> Inscription</a>
      @endauth
    </div>
  </div>
</nav>

<!-- HERO AMÉLIORÉ -->
<section class="hero">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="row align-items-center" style="min-height:100vh; padding-top:90px; padding-bottom:60px;">
      <div class="col-lg-8">

        {{-- Badge eyebrow --}}
      

        {{-- Titre restructuré et plus professionnel --}}
        <h1>
          Prenez soin de<br>
          votre santé mentale <br>
          <em>en toute confiance</em>
        </h1>

        {{-- Sous-titre --}}
        <p class="hero-sub">
          <strong>Jokko Santé</strong> est une plateforme gratuite et confidentielle
          dédiée aux étudiants et aux femmes au Sénégal.
          Accédez à un soutien psychologique professionnel, une communauté bienveillante
          et des ressources adaptées à votre réalité.
        </p>


        {{-- Stats pertinentes sans chiffres fictifs --}}
        <div class="hero-stats">
          <div class="hero-stat">
            <div class="hero-stat-icon"><i class="bi bi-shield-check"></i></div>
            <div>
              <strong>100%</strong>
              <span>Confidentiel & gratuit</span>
            </div>
          </div>
          <div class="hero-stat-sep"></div>
          <div class="hero-stat">
            <div class="hero-stat-icon"><i class="bi bi-clock"></i></div>
            <div>
              <strong>24h/24</strong>
              <span>Assistant disponible</span>
            </div>
          </div>
          <div class="hero-stat-sep"></div>
          <div class="hero-stat">
            <div class="hero-stat-icon"><i class="bi bi-heart-pulse"></i></div>
            <div>
              <strong>PHQ-9</strong>
              <span>Test cliniquement validé</span>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-band">
  <div class="container">
    <div class="row g-0">
      <div class="col-md-4 stat-item">
        <div class="stat-num">280M+</div>
        <div class="stat-label">personnes touchées par la dépression dans le monde</div>
      </div>
      <div class="col-md-4 stat-item">
        <div class="stat-num">35%</div>
        <div class="stat-label">des étudiants présentent des symptômes dépressifs</div>
      </div>
      <div class="col-md-4 stat-item">
        <div class="stat-num">100%</div>
        <div class="stat-label">gratuit, confidentiel et adapté au contexte sénégalais</div>
      </div>
    </div>
  </div>
</div>

<!-- SERVICES -->
<section class="section-services" id="services">
  <div class="container">
    <div class="row mb-5">
      <div class="col-lg-5">
        <span class="eyebrow">Ce que nous offrons</span>
        <h2 class="section-title">Des services pensés<br>pour <em style="font-style:italic;color:var(--sage)">vous</em></h2>
      </div>
      <div class="col-lg-5 offset-lg-2 d-flex align-items-end">
        <p style="color:var(--muted);line-height:1.85;font-size:.92rem;">
          Une plateforme numérique innovante qui allie entraide locale et soutien psychologique professionnel pour tous les citoyens.
        </p>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3 fade-up">
        <div class="service-card">
          <div class="s-icon"><i class="bi bi-journal-richtext"></i></div>
          <h4>Sensibilisation</h4>
          <p>Articles éducatifs et guides pratiques pour mieux comprendre la santé mentale sans tabou.</p>
          <a href="/sensibilisation" class="service-link">Découvrir <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-up delay-1">
        <div class="service-card">
          <div class="s-icon"><i class="bi bi-clipboard2-pulse"></i></div>
          <h4>Prévention</h4>
          <p>Test PHQ-9 validé cliniquement pour évaluer votre état mental et détecter les signes précoces.</p>
          <a href="/prevention" class="service-link">Faire le test <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-up delay-2">
        <div class="service-card">
          <div class="s-icon"><i class="bi bi-chat-dots"></i></div>
          <h4>Assistance</h4>
          <p>Chat anonyme, forum communautaire et orientation vers des professionnels de santé mentale.</p>
          <a href="/assistance" class="service-link">Obtenir de l'aide <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 fade-up delay-3">
        <div class="service-card">
          <div class="s-icon"><i class="bi bi-calendar2-check"></i></div>
          <h4>Rendez-vous</h4>
          <p>Prenez rendez-vous facilement avec un psychologue partenaire, en toute sécurité.</p>
          <a href="/rendezvous" class="service-link">Réserver <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHY -->
<section class="section-why">
  <div class="why-wrapper">
    <div class="why-image-col">
      <img src="/images/why.png" alt="Jokko Santé la solution">
      <div class="why-image-col-overlay"></div>
    </div>
    <div class="why-content-col">
      <span class="eyebrow" style="color:rgba(232,245,228,.65);">Nos engagements</span>
      <h2 class="section-title" style="color:white;">Pourquoi choisir<br><em style="font-style:italic;color:var(--light)">Jokko Santé</em> ?</h2>
      <div class="why-cards-wrap">
        <div class="why-card fade-up">
          <div class="why-card-icon"><i class="bi bi-lightning-charge"></i></div>
          <div>
            <h5>Réponse rapide</h5>
            <p>Une assistance immédiate disponible 24h/24 pour répondre à vos situations de détresse psychologique.</p>
          </div>
        </div>
        <div class="why-card fade-up delay-1">
          <div class="why-card-icon"><i class="bi bi-shield-lock"></i></div>
          <div>
            <h5>Données protégées</h5>
            <p>Votre confidentialité est sacrée. Toutes vos informations sont chiffrées et sécurisées.</p>
          </div>
        </div>
        <div class="why-card fade-up delay-2">
          <div class="why-card-icon"><i class="bi bi-globe2"></i></div>
          <div>
            <h5>Accessible partout</h5>
            <p>Disponible sur mobile et desktop, optimisée pour les connexions faibles au Sénégal.</p>
          </div>
        </div>
        <div class="why-card fade-up delay-3">
          <div class="why-card-icon"><i class="bi bi-heart"></i></div>
          <div>
            <h5>Approche humaine</h5>
            <p>Des professionnels de santé et des Badienou Gokh pour un accompagnement ancré dans notre culture.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- AUDIENCES -->
<section class="section-audiences">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow">Pour qui ?</span>
      <h2 class="section-title">Conçu pour <em style="font-style:italic;color:var(--sage)">celles et ceux</em><br>qui en ont besoin</h2>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-5 fade-up">
        <div class="audience-card">
          <div class="aud-img-wrap">
            <img src="/images/femme.png" alt="Femme en détresse">
            <div class="aud-img-overlay"></div>
            <span class="aud-img-tag">Femmes</span>
          </div>
          <div class="aud-body">
            <span class="aud-badge"><i class="bi bi-heart"></i> Accompagnement humain</span>
            <h3>Un espace sûr pour vous</h3>
            <p>Que vous traversiez des difficultés conjugales, un isolement affectif ou un manque de soutien, Jokko Santé vous offre un espace confidentiel — sans jugement.</p>
            <ul class="aud-list">
              <li><i class="bi bi-chat-heart"></i> Écoute confidentielle</li>
              <li><i class="bi bi-people"></i> Réseau de soutien féminin</li>
              <li><i class="bi bi-shield-check"></i> Accompagnement sécurisé</li>
            </ul>
            <a href="/register" class="aud-btn">Rejoindre <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-5 fade-up delay-1">
        <div class="audience-card">
          <div class="aud-img-wrap">
            <img src="/images/etudiant.png" alt="Étudiant stressé">
            <div class="aud-img-overlay"></div>
            <span class="aud-img-tag">Étudiants</span>
          </div>
          <div class="aud-body">
            <span class="aud-badge"><i class="bi bi-mortarboard"></i> Soutien au quotidien</span>
            <h3>Gérez le stress académique</h3>
            <p>Pression des examens, isolement, anxiété... vous n'êtes pas seul(e). Jokko Santé connecte les étudiants à des ressources adaptées et à une communauté bienveillante.</p>
            <ul class="aud-list">
              <li><i class="bi bi-book"></i> Soutien en période d'examens</li>
              <li><i class="bi bi-emoji-smile"></i> Gestion du stress & anxiété</li>
              <li><i class="bi bi-diagram-3"></i> Entraide entre pairs</li>
            </ul>
            <a href="/register" class="aud-btn">Rejoindre <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MISSION -->
<section class="section-mission">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5 d-flex justify-content-center fade-scale">
        <div class="mission-visual">
          <div class="m-ring m-ring-1"></div>
          <div class="m-ring m-ring-2"></div>
          <div class="m-core">
            <span style="font-size:2.2rem;">🌿</span>
            <span class="m-core-text">Notre<br>Vision</span>
          </div>
        </div>
      </div>
      <div class="col-lg-7 fade-up delay-1">
        <span class="eyebrow">Notre mission</span>
        <h2 class="section-title">Briser les tabous,<br>tisser des <em style="font-style:italic;color:var(--sage)">liens</em></h2>
        <p style="color:var(--muted);font-size:.92rem;line-height:1.95;margin-top:18px;">
          Jokko Santé est née d'un constat simple : trop de personnes souffrent en silence, faute d'un espace de confiance. Nous croyons que la santé mentale est un droit, pas un luxe.
        </p>
        <div class="mission-vals">
          <div class="m-val">
            <span class="m-dot" style="background:var(--mint)"></span>
            <div><strong>Solidarité</strong><span>Personne ne devrait affronter ses difficultés seul(e)</span></div>
          </div>
          <div class="m-val">
            <span class="m-dot" style="background:var(--sage)"></span>
            <div><strong>Confidentialité</strong><span>Vos informations restent entièrement privées et sécurisées</span></div>
          </div>
          <div class="m-val">
            <span class="m-dot" style="background:var(--forest)"></span>
            <div><strong>Inclusion</strong><span>Pour toutes et tous, sans exception ni discrimination</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section-cta">
  <div class="container">
    <h2>Prêt(e) à rejoindre<br>la communauté ?</h2>
    <p>Inscrivez-vous gratuitement et commencez immédiatement à bénéficier de notre réseau d'entraide et de soutien psychologique.</p>
    @auth
      <a href="/dashboard" class="btn-cta">🌿 Mon espace <i class="bi bi-arrow-right"></i></a>
    @else
      <a href="/register" class="btn-cta">🌿 Créer mon compte <i class="bi bi-arrow-right"></i></a>
    @endauth
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <div class="footer-brand">🌿 Jokko<span>Santé</span></div>
        <p>Plateforme d'entraide communautaire et de santé mentale au Sénégal</p>
       
    </div>
    <div class="f-divider"></div>
    <p class="f-copy text-center">© {{ date('Y') }} Jokko Santé — Tous droits réservés</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const navbar = document.getElementById('navbar');
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
  });
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  document.querySelectorAll('.fade-up, .fade-scale').forEach(el => observer.observe(el));
</script>
</body>
</html>