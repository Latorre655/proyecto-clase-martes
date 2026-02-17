<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GameStore — @yield('title')</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600&display=swap" rel="stylesheet"/>
  <style>
    /* ═══════════════════════════════════════════
       GAMESTORE — BASE LAYOUT + VISTAS
    ═══════════════════════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:          #060912;
      --surface:     #0d1120;
      --surface-2:   #111827;
      --border:      #1e2d4a;
      --accent:      #00d4ff;
      --accent-alt:  #7c3aed;
      --accent-glow: rgba(0,212,255,0.25);
      --text:        #e2e8f0;
      --text-muted:  #64748b;
      --text-dim:    #94a3b8;
      --success:     #00c97a;
      --danger:      #ff4757;
      --font-display:'Orbitron', monospace;
      --font-body:   'Rajdhani', sans-serif;
      --radius:      6px;
      --nav-h:       68px;
      --transition:  0.25s cubic-bezier(0.4,0,0.2,1);
    }

    html { font-size: 16px; scroll-behavior: smooth; }

    body {
      background-color: var(--bg);
      color: var(--text);
      font-family: var(--font-body);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ════════════════════════════
       FONDO
    ════════════════════════════ */
    .bg-grid {
      position: fixed; inset: 0;
      background-image:
        linear-gradient(rgba(0,212,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,212,255,0.03) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none; z-index: 0;
    }
    .glow-orb {
      position: fixed; border-radius: 50%; filter: blur(100px);
      pointer-events: none; z-index: 0;
      animation: orb-float 8s ease-in-out infinite;
    }
    .glow-1 { width:500px; height:500px; background:rgba(0,212,255,0.08); top:-150px; right:-100px; }
    .glow-2 { width:400px; height:400px; background:rgba(124,58,237,0.1); bottom:-100px; left:-100px; animation-delay:4s; }

    @keyframes orb-float {
      0%,100% { transform:translateY(0) scale(1); }
      50%     { transform:translateY(-30px) scale(1.05); }
    }

    /* ════════════════════════════
       NAVBAR
    ════════════════════════════ */
    .navbar {
      position: fixed; top:0; left:0; right:0;
      height: var(--nav-h);
      background: rgba(6,9,18,0.88);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border-bottom: 1px solid var(--border);
      z-index: 100;
      display: flex; align-items: center;
      padding: 0 2rem; gap: 2rem;
    }
    .navbar::before {
      content: '';
      position: absolute; top:0; left:0; right:0; height:2px;
      background: linear-gradient(90deg, transparent, var(--accent), var(--accent-alt), transparent);
      opacity: .7;
    }

    .nav-logo {
      display: flex; align-items: center; gap: .45rem;
      font-family: var(--font-display); font-size: 1.15rem;
      font-weight: 900; letter-spacing: .1em; text-transform: uppercase;
      text-decoration: none; color: var(--text); flex-shrink: 0;
    }
    .nav-logo-icon { font-size: 1.1rem; filter: drop-shadow(0 0 10px var(--accent)); }
    .nav-accent { color: var(--accent); text-shadow: 0 0 18px var(--accent), 0 0 36px rgba(0,212,255,.35); }

    .nav-divider { width:1px; height:28px; background:var(--border); flex-shrink:0; }

    .nav-links {
      display: flex; align-items: center; gap: .25rem;
      list-style: none; flex: 1;
    }
    .nav-links a {
      display: flex; align-items: center; gap: .4rem;
      font-family: var(--font-display); font-size: .6rem;
      font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
      text-decoration: none; color: var(--text-muted);
      padding: .5rem .85rem; border-radius: var(--radius);
      border: 1px solid transparent;
      transition: all var(--transition); position: relative;
    }
    .nav-links a:hover  { color:var(--text); background:rgba(255,255,255,.04); border-color:var(--border); }
    .nav-links a.active { color:var(--accent); background:rgba(0,212,255,.08); border-color:rgba(0,212,255,.2); }
    .nav-links a.active::after {
      content: '';
      position: absolute; bottom:-1px; left:20%; right:20%; height:2px;
      background: var(--accent); border-radius:2px; box-shadow:0 0 8px var(--accent);
    }

    .nav-cta {
      display: flex; align-items: center; gap: .45rem;
      font-family: var(--font-display); font-size: .6rem;
      font-weight: 700; letter-spacing: .12em; text-transform: uppercase;
      text-decoration: none; color: #fff;
      padding: .55rem 1.1rem; border-radius: var(--radius);
      background: linear-gradient(135deg, #006b82, #00a8cc);
      border: 1px solid rgba(0,212,255,.35);
      box-shadow: 0 4px 18px rgba(0,212,255,.2);
      transition: all var(--transition); flex-shrink: 0;
      position: relative; overflow: hidden;
    }
    .nav-cta-shine {
      position: absolute; inset: 0;
      background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,.12), transparent 70%);
      transform: translateX(-100%); transition: transform .5s ease;
    }
    .nav-cta:hover .nav-cta-shine { transform: translateX(100%); }
    .nav-cta:hover { transform:translateY(-1px); box-shadow:0 8px 28px rgba(0,212,255,.35), 0 0 0 1px var(--accent); }

    .nav-hamburger {
      display: none; flex-direction: column; gap: 5px;
      cursor: pointer; padding: 4px; margin-left: auto;
      background: none; border: none;
    }
    .nav-hamburger span { display:block; width:22px; height:2px; background:var(--text-dim); border-radius:2px; transition:all .3s ease; }
    .nav-hamburger.open span:nth-child(1) { transform:rotate(45deg) translate(5px,5px); }
    .nav-hamburger.open span:nth-child(2) { opacity:0; }
    .nav-hamburger.open span:nth-child(3) { transform:rotate(-45deg) translate(5px,-5px); }

    /* ════════════════════════════
       PAGE WRAPPER
    ════════════════════════════ */
    .container {
      position: relative; z-index: 1;
      width: 100%; max-width: 1100px;
      margin: 0 auto;
      padding-top: calc(var(--nav-h) + 2.5rem);
      padding-bottom: 3rem;
      padding-left: 1.5rem;
      padding-right: 1.5rem;
      display: flex; flex-direction: column; gap: 2rem;
    }

    /* ════════════════════════════
       HEADER DE PÁGINA
    ════════════════════════════ */
    .page-header { text-align: center; }
    .page-title {
      display: inline-flex; align-items: center; gap: .5rem;
      font-family: var(--font-display); font-size: 2rem;
      font-weight: 900; letter-spacing: .1em; text-transform: uppercase;
    }
    .page-title-icon { font-size: 1.6rem; filter: drop-shadow(0 0 12px var(--accent)); }
    .accent { color: var(--accent); text-shadow: 0 0 20px var(--accent), 0 0 40px rgba(0,212,255,.4); }
    .page-subtitle {
      margin-top: .4rem; font-size: .8rem; color: var(--text-muted);
      letter-spacing: .25em; text-transform: uppercase; font-weight: 300;
    }

    /* ════════════════════════════
       CATÁLOGO — TOP BAR
    ════════════════════════════ */
    .top-bar {
      display: flex; align-items: center;
      justify-content: space-between; flex-wrap: wrap; gap: 1rem;
    }
    .top-left { display: flex; align-items: center; gap: 1.25rem; flex-wrap: wrap; }

    .section-title { display: flex; align-items: center; gap: .75rem; }
    .section-icon  { font-size: 1.3rem; filter: drop-shadow(0 0 8px rgba(0,212,255,.6)); }
    .section-title h2 {
      font-family: var(--font-display); font-size: 1rem;
      font-weight: 700; letter-spacing: .08em; text-transform: uppercase;
    }
    .section-count {
      font-size: .65rem; font-family: var(--font-display);
      color: var(--accent); border: 1px solid rgba(0,212,255,.25);
      background: rgba(0,212,255,.06); padding: .2rem .6rem;
      border-radius: 20px; letter-spacing: .1em;
    }

    .filter-bar { display: flex; gap: .5rem; flex-wrap: wrap; }
    .filter-btn {
      font-family: var(--font-display); font-size: .6rem; font-weight: 700;
      letter-spacing: .1em; text-transform: uppercase; cursor: pointer;
      padding: .4rem .9rem; border-radius: 20px;
      border: 1px solid var(--border); background: transparent;
      color: var(--text-muted); transition: all var(--transition);
    }
    .filter-btn:hover  { border-color: var(--accent); color: var(--accent); }
    .filter-btn.active { background: rgba(0,212,255,.1); border-color: var(--accent); color: var(--accent); }

    /* ════════════════════════════
       CATÁLOGO — GRID Y CARDS
    ════════════════════════════ */
    .catalog-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px,1fr));
      gap: 1.5rem;
    }

    .product-card {
      background: var(--surface); border: 1px solid var(--border);
      border-radius: 14px; overflow: hidden;
      position: relative; display: flex; flex-direction: column;
      transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
      box-shadow: 0 8px 32px rgba(0,0,0,.4);
      animation: card-in .5s cubic-bezier(.4,0,.2,1) both;
    }
    .product-card:nth-child(1){animation-delay:.05s}
    .product-card:nth-child(2){animation-delay:.10s}
    .product-card:nth-child(3){animation-delay:.15s}
    .product-card:nth-child(4){animation-delay:.20s}
    .product-card:nth-child(5){animation-delay:.25s}
    .product-card:nth-child(6){animation-delay:.30s}

    @keyframes card-in {
      from { opacity:0; transform:translateY(22px); }
      to   { opacity:1; transform:translateY(0); }
    }

    .product-card::before {
      content:''; position:absolute; top:0; left:0; right:0; height:2px;
      background:linear-gradient(90deg,transparent,var(--accent),var(--accent-alt),transparent);
      opacity:0; transition:opacity var(--transition);
    }
    .product-card:hover::before { opacity:.75; }
    .product-card:hover {
      transform:translateY(-6px);
      border-color:rgba(0,212,255,.28);
      box-shadow:0 20px 50px rgba(0,0,0,.55), 0 0 0 1px rgba(0,212,255,.12);
    }

    .product-card.inactive { opacity:.5; }
    .product-card.inactive .dim-overlay {
      position:absolute; inset:0; background:rgba(6,9,18,.35);
      pointer-events:none; z-index:2; border-radius:14px;
    }

    .product-img-wrap {
      position:relative; width:100%; aspect-ratio:16/10;
      background:var(--surface-2); overflow:hidden;
    }
    .product-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .product-card:hover .product-img-wrap img { transform:scale(1.07); }
    .product-img-overlay {
      position:absolute; inset:0;
      background:linear-gradient(to bottom, transparent 50%, var(--surface) 100%);
    }

    .status-badge {
      position:absolute; top:.75rem; right:.75rem; z-index:3;
      font-family:var(--font-display); font-size:.55rem; font-weight:700;
      letter-spacing:.12em; text-transform:uppercase;
      padding:.25rem .65rem; border-radius:20px;
      display:flex; align-items:center; gap:.35rem;
    }
    .status-badge.active   { background:rgba(0,201,122,.15); border:1px solid rgba(0,201,122,.4); color:var(--success); box-shadow:0 0 12px rgba(0,201,122,.2); }
    .status-badge.inactive { background:rgba(100,116,139,.15); border:1px solid rgba(100,116,139,.3); color:var(--text-muted); }
    .status-dot { width:5px; height:5px; border-radius:50%; }
    .status-badge.active   .status-dot { background:var(--success); box-shadow:0 0 6px var(--success); animation:pulse-dot 2s ease-in-out infinite; }
    .status-badge.inactive .status-dot { background:var(--text-muted); }

    @keyframes pulse-dot {
      0%,100%{ opacity:1; transform:scale(1); }
      50%    { opacity:.4; transform:scale(.65); }
    }

    .product-body     { padding:1.25rem 1.25rem .75rem; display:flex; flex-direction:column; gap:.55rem; flex:1; }
    .product-meta     { display:flex; align-items:center; justify-content:space-between; }
    .product-brand    { font-size:.65rem; font-family:var(--font-display); color:var(--accent); letter-spacing:.15em; text-transform:uppercase; opacity:.75; }
    .product-category { font-size:.6rem; color:var(--text-muted); letter-spacing:.08em; text-transform:uppercase; }
    .product-name     { font-family:var(--font-display); font-size:.92rem; font-weight:700; letter-spacing:.03em; line-height:1.3; }
    .product-desc     { font-size:.9rem; color:var(--text-dim); line-height:1.55; font-weight:300; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical; overflow:hidden; }

    .product-footer { padding:.9rem 1.25rem 1.25rem; display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border); }
    .product-price  { display:flex; align-items:baseline; gap:.2rem; }
    .price-symbol   { font-family:var(--font-display); font-size:.75rem; color:var(--accent); font-weight:700; }
    .price-amount   { font-family:var(--font-display); font-size:1.35rem; font-weight:900; text-shadow:0 0 20px rgba(0,212,255,.2); }
    .price-cents    { font-family:var(--font-display); font-size:.7rem; color:var(--text-muted); }

    .btn-buy {
      font-family:var(--font-display); font-size:.62rem; font-weight:700;
      letter-spacing:.12em; text-transform:uppercase;
      padding:.55rem 1.1rem; border-radius:var(--radius);
      background:linear-gradient(135deg,#006b82,#00a8cc);
      color:#fff; border:1px solid rgba(0,212,255,.3);
      cursor:pointer; transition:all var(--transition);
      box-shadow:0 4px 16px rgba(0,212,255,.15);
      position:relative; overflow:hidden;
    }
    .btn-buy::after { content:''; position:absolute; inset:0; background:linear-gradient(135deg,transparent 30%,rgba(255,255,255,.12),transparent 70%); transform:translateX(-100%); transition:transform .5s ease; }
    .btn-buy:hover::after { transform:translateX(100%); }
    .btn-buy:hover { transform:translateY(-1px); box-shadow:0 8px 22px rgba(0,212,255,.28); }
    .btn-buy:disabled { background:var(--surface-2); color:var(--text-muted); border-color:var(--border); cursor:not-allowed; box-shadow:none; transform:none; }
    .btn-buy:disabled::after { display:none; }

    /* ════════════════════════════
       FORMULARIO — CARD
    ════════════════════════════ */
    .form-card {
      background:var(--surface); border:1px solid var(--border);
      border-radius:14px; padding:2.5rem;
      position:relative; overflow:hidden;
      box-shadow:0 0 0 1px rgba(0,212,255,.05), 0 24px 60px rgba(0,0,0,.55), inset 0 1px 0 rgba(255,255,255,.04);
      animation:card-in .6s cubic-bezier(.4,0,.2,1) both;
      max-width: 700px; margin: 0 auto; width: 100%;
    }
    .form-card::before {
      content:''; position:absolute; top:0; left:0; right:0; height:2px;
      background:linear-gradient(90deg,transparent,var(--accent),var(--accent-alt),transparent);
      opacity:.85;
    }
    .form-card::after {
      content:''; position:absolute; bottom:0; right:0;
      width:80px; height:80px;
      border-bottom:2px solid rgba(0,212,255,.15);
      border-right:2px solid rgba(0,212,255,.15);
      border-radius:0 0 14px 0;
    }

    .form-card-header { margin-bottom:2rem; }
    .form-card-title  { display:flex; align-items:center; gap:.75rem; }
    .form-card-icon   { font-size:1.6rem; filter:drop-shadow(0 0 10px rgba(0,212,255,.7)); }
    .form-card-title h1 {
      font-family:var(--font-display); font-size:1.2rem;
      font-weight:700; letter-spacing:.06em; text-transform:uppercase;
    }
    .form-card-badge {
      margin-left:auto; font-size:.65rem; font-family:var(--font-display);
      color:var(--accent); border:1px solid rgba(0,212,255,.25);
      background:rgba(0,212,255,.06); padding:.2rem .6rem;
      border-radius:20px; letter-spacing:.1em; text-transform:uppercase;
    }
    .form-card-line { margin-top:1rem; height:1px; background:linear-gradient(90deg,var(--accent),transparent); opacity:.35; }

    /* ── Campos ── */
    .form        { display:flex; flex-direction:column; gap:1.5rem; }
    .form-row    { display:grid; grid-template-columns:1fr 1fr; gap:1.25rem; }
    .form-group  { display:flex; flex-direction:column; gap:.5rem; }

    .label {
      display:flex; align-items:center; gap:.6rem;
      font-size:.72rem; font-weight:600; letter-spacing:.15em;
      text-transform:uppercase; color:var(--text-dim);
      cursor:pointer; transition:color var(--transition);
    }
    .label:hover { color:var(--accent); }
    .label-tag   { font-family:var(--font-display); font-size:.58rem; color:var(--accent); opacity:.55; }

    .input-wrapper { position:relative; display:flex; align-items:center; }
    .input-border  {
      position:absolute; inset:0; border:1px solid var(--border);
      border-radius:var(--radius); pointer-events:none;
      transition:border-color var(--transition), box-shadow var(--transition);
    }
    .input-wrapper.focused .input-border {
      border-color:var(--accent);
      box-shadow:0 0 0 3px var(--accent-glow), 0 0 20px rgba(0,212,255,.1);
    }

    .input {
      width:100%; background:var(--surface-2); border:none; outline:none;
      border-radius:var(--radius); padding:.78rem 1rem;
      font-family:var(--font-body); font-size:1rem; font-weight:400;
      color:var(--text); transition:background var(--transition);
      appearance:none; -webkit-appearance:none;
    }
    .input::placeholder { color:var(--text-muted); font-weight:300; }
    .input:focus        { background:#131c2e; }

    .input-prefix { position:absolute; left:.9rem; color:var(--accent); font-family:var(--font-display); font-size:.85rem; font-weight:700; pointer-events:none; z-index:1; }
    .input.has-prefix { padding-left:1.8rem; }

    .select {
      cursor:pointer; padding-right:2.5rem;
      background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%2300d4ff' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
      background-repeat:no-repeat; background-position:right 1rem center;
    }
    .select option { background:var(--surface-2); color:var(--text); }

    .textarea  { resize:vertical; min-height:130px; line-height:1.65; }
    .char-hint { font-size:.68rem; color:var(--text-muted); letter-spacing:.05em; margin-top:-.2rem; }

    .divider { display:flex; align-items:center; gap:.75rem; opacity:.3; }
    .divider span { font-size:.6rem; font-family:var(--font-display); color:var(--accent); }
    .divider::before,.divider::after { content:''; flex:1; height:1px; background:var(--border); }

    .form-actions { display:flex; justify-content:flex-end; gap:1rem; margin-top:.25rem; }

    .btn {
      position:relative; display:inline-flex; align-items:center; gap:.5rem;
      padding:.8rem 1.8rem; border:none; border-radius:var(--radius);
      font-family:var(--font-display); font-size:.7rem; font-weight:700;
      letter-spacing:.12em; text-transform:uppercase;
      cursor:pointer; transition:all var(--transition); overflow:hidden;
      text-decoration:none;
    }
    .btn-ghost   { background:transparent; border:1px solid var(--border); color:var(--text-muted); }
    .btn-ghost:hover { border-color:var(--danger); color:var(--danger); background:rgba(255,71,87,.06); }
    .btn-primary {
      background:linear-gradient(135deg,#006b82,#00a8cc); color:#fff;
      border:1px solid rgba(0,212,255,.3); box-shadow:0 4px 20px rgba(0,212,255,.2);
    }
    .btn-primary:hover  { transform:translateY(-2px); box-shadow:0 10px 32px rgba(0,212,255,.38), 0 0 0 1px var(--accent); }
    .btn-primary:active { transform:translateY(0); }
    .btn-shimmer {
      position:absolute; inset:0;
      background:linear-gradient(135deg,transparent 30%,rgba(255,255,255,.12),transparent 70%);
      transform:translateX(-100%); transition:transform .55s ease;
    }
    .btn-primary:hover .btn-shimmer { transform:translateX(100%); }
    .btn-primary.success { pointer-events:none; background:linear-gradient(135deg,#00704a,#00a36e); box-shadow:0 8px 28px rgba(0,163,110,.35); }

    .field-error { font-size:.7rem; color:var(--danger); margin-top:.15rem; }

    /* ════════════════════════════
       FOOTER
    ════════════════════════════ */
    .footer {
      position: relative; z-index: 1;
      text-align:center; font-size:.68rem;
      color:var(--text-muted); letter-spacing:.12em; opacity:.55;
      padding: 1.5rem 0 2rem;
    }
    .sep { margin:0 .5rem; color:var(--accent); }

    /* ════════════════════════════
       RESPONSIVE
    ════════════════════════════ */
    @media (max-width:768px) {
      .navbar { padding:0 1.25rem; }
      .nav-links {
        display:none; flex-direction:column;
        position:fixed; top:var(--nav-h); left:0; right:0;
        background:rgba(6,9,18,.97);
        border-bottom:1px solid var(--border);
        padding:1rem 1.25rem; gap:.25rem;
        backdrop-filter:blur(18px);
      }
      .nav-links.open { display:flex; }
      .nav-divider    { display:none; }
      .nav-hamburger  { display:flex; }
      .nav-cta        { display:none; }
      .form-card      { padding:1.75rem 1.25rem; }
      .form-row       { grid-template-columns:1fr; }
      .form-card-badge{ display:none; }
    }
    @media (max-width:640px) {
      .catalog-grid { grid-template-columns:1fr; }
      .top-bar      { flex-direction:column; align-items:flex-start; }
    }
  </style>
</head>
<body>

  <div class="bg-grid"></div>
  <div class="glow-orb glow-1"></div>
  <div class="glow-orb glow-2"></div>

  <!-- ════ NAVBAR ════ -->
  <nav class="navbar">
    <a class="nav-logo" href="#">
      <span class="nav-logo-icon">⚡</span>
      GAME<span class="nav-accent">STORE</span>
    </a>

    <div class="nav-divider"></div>

    <ul class="nav-links" id="navLinks">
      <li><a href="#">🕹️ Catálogo</a></li>
      <li><a href="#">➕ Agregar Producto</a></li>
      <li><a href="#">📦 Pedidos</a></li>
      <li><a href="#">📊 Estadísticas</a></li>
    </ul>

    <a href="#" class="nav-cta">
      <span class="nav-cta-shine"></span>
      ＋ Nuevo Producto
    </a>

    <button class="nav-hamburger" id="hamburger" onclick="toggleMenu()">
      <span></span><span></span><span></span>
    </button>
  </nav>

  <!-- ════ CONTENIDO ════ -->
  @yield('content')

  <!-- ════ FOOTER ════ -->
  <footer class="footer">
    © 2026 GameStore<span class="sep">|</span>Todos los derechos reservados
  </footer>

</body>
</html>
