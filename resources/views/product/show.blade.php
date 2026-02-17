@extends('layouts.app')
@section('content')

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GameStore — DualSense Edge</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600&display=swap" rel="stylesheet"/>
  <style>
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
    body { background-color: var(--bg); color: var(--text); font-family: var(--font-body); min-height: 100vh; overflow-x: hidden; }

    /* FONDO */
    .bg-grid {
      position: fixed; inset: 0;
      background-image:
        linear-gradient(rgba(0,212,255,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,212,255,0.03) 1px, transparent 1px);
      background-size: 40px 40px;
      pointer-events: none; z-index: 0;
    }
    .glow-orb { position: fixed; border-radius: 50%; filter: blur(100px); pointer-events: none; z-index: 0; animation: orb-float 8s ease-in-out infinite; }
    .glow-1 { width:500px; height:500px; background:rgba(0,212,255,0.08); top:-150px; right:-100px; }
    .glow-2 { width:400px; height:400px; background:rgba(124,58,237,0.1); bottom:-100px; left:-100px; animation-delay:4s; }
    @keyframes orb-float { 0%,100%{transform:translateY(0) scale(1);} 50%{transform:translateY(-30px) scale(1.05);} }

    /* NAVBAR */
    .navbar {
      position: fixed; top:0; left:0; right:0; height: var(--nav-h);
      background: rgba(6,9,18,0.88); backdrop-filter: blur(18px);
      border-bottom: 1px solid var(--border); z-index: 100;
      display: flex; align-items: center; padding: 0 2rem; gap: 2rem;
    }
    .navbar::before {
      content: ''; position: absolute; top:0; left:0; right:0; height:2px;
      background: linear-gradient(90deg, transparent, var(--accent), var(--accent-alt), transparent);
      opacity: .7;
    }
    .nav-logo { display:flex; align-items:center; gap:.45rem; font-family:var(--font-display); font-size:1.15rem; font-weight:900; letter-spacing:.1em; text-transform:uppercase; text-decoration:none; color:var(--text); flex-shrink:0; }
    .nav-logo-icon { font-size:1.1rem; filter:drop-shadow(0 0 10px var(--accent)); }
    .nav-accent { color:var(--accent); text-shadow:0 0 18px var(--accent), 0 0 36px rgba(0,212,255,.35); }
    .nav-divider { width:1px; height:28px; background:var(--border); flex-shrink:0; }
    .nav-links { display:flex; align-items:center; gap:.25rem; list-style:none; flex:1; }
    .nav-links a { display:flex; align-items:center; gap:.4rem; font-family:var(--font-display); font-size:.6rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-decoration:none; color:var(--text-muted); padding:.5rem .85rem; border-radius:var(--radius); border:1px solid transparent; transition:all var(--transition); }
    .nav-links a:hover { color:var(--text); background:rgba(255,255,255,.04); border-color:var(--border); }
    .nav-links a.active { color:var(--accent); background:rgba(0,212,255,.08); border-color:rgba(0,212,255,.2); }

    /* CONTAINER */
    .container {
      position: relative; z-index: 1;
      width: 100%; max-width: 1100px;
      margin: 0 auto;
      padding-top: calc(var(--nav-h) + 2.5rem);
      padding-bottom: 3rem;
      padding-left: 1.5rem; padding-right: 1.5rem;
      display: flex; flex-direction: column; gap: 2rem;
    }

    /* ANIMACIÓN */
    @keyframes card-in { from{opacity:0;transform:translateY(22px);} to{opacity:1;transform:translateY(0);} }
    @keyframes pulse-dot { 0%,100%{opacity:1;transform:scale(1);} 50%{opacity:.4;transform:scale(.65);} }

    /* BREADCRUMB */
    .breadcrumb { display:flex; align-items:center; gap:.5rem; font-family:var(--font-display); font-size:.6rem; letter-spacing:.12em; text-transform:uppercase; color:var(--text-muted); }
    .breadcrumb a { color:var(--text-muted); text-decoration:none; transition:color var(--transition); }
    .breadcrumb a:hover { color:var(--accent); }
    .breadcrumb-sep { color:var(--border); }
    .breadcrumb-current { color:var(--accent); }

    /* SHOW GRID */
    .show-grid { display:grid; grid-template-columns:1fr 1fr; gap:2rem; align-items:start; }

    /* PANEL IMAGEN */
    .show-img-panel {
      background:var(--surface); border:1px solid var(--border);
      border-radius:14px; overflow:hidden; position:relative;
      box-shadow:0 8px 32px rgba(0,0,0,.4);
      animation:card-in .5s cubic-bezier(.4,0,.2,1) both;
    }
    .show-img-panel::before {
      content:''; position:absolute; top:0; left:0; right:0; height:2px;
      background:linear-gradient(90deg,transparent,var(--accent),var(--accent-alt),transparent);
      opacity:.85; z-index:2;
    }
    .show-img-wrap { position:relative; width:100%; aspect-ratio:4/3; background:var(--surface-2); overflow:hidden; }
    .show-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .6s ease; }
    .show-img-panel:hover .show-img-wrap img { transform:scale(1.04); }
    .show-img-gradient { position:absolute; inset:0; background:linear-gradient(to bottom,transparent 55%,rgba(6,9,18,.7) 100%); }

    /* STATUS BADGE */
    .status-badge {
      position:absolute; top:.9rem; left:.9rem; z-index:3;
      font-family:var(--font-display); font-size:.55rem; font-weight:700;
      letter-spacing:.12em; text-transform:uppercase;
      padding:.25rem .65rem; border-radius:20px;
      display:flex; align-items:center; gap:.35rem;
    }
    .status-badge.active { background:rgba(0,201,122,.15); border:1px solid rgba(0,201,122,.4); color:var(--success); box-shadow:0 0 12px rgba(0,201,122,.2); }
    .status-dot { width:5px; height:5px; border-radius:50%; }
    .status-badge.active .status-dot { background:var(--success); box-shadow:0 0 6px var(--success); animation:pulse-dot 2s ease-in-out infinite; }

    /* PANEL INFO */
    .show-info-panel { display:flex; flex-direction:column; gap:1.5rem; animation:card-in .5s .1s cubic-bezier(.4,0,.2,1) both; }

    /* SHOW CARD */
    .show-card {
      background:var(--surface); border:1px solid var(--border);
      border-radius:14px; padding:1.75rem; position:relative; overflow:hidden;
      box-shadow:0 8px 32px rgba(0,0,0,.4);
    }
    .show-card::before {
      content:''; position:absolute; top:0; left:0; right:0; height:2px;
      background:linear-gradient(90deg,transparent,var(--accent),var(--accent-alt),transparent);
      opacity:.85;
    }
    .show-card.sm { padding:1.35rem 1.5rem; }

    .show-meta { display:flex; align-items:center; gap:.75rem; margin-bottom:.75rem; }
    .show-brand { font-family:var(--font-display); font-size:.62rem; font-weight:700; letter-spacing:.15em; text-transform:uppercase; color:var(--accent); opacity:.85; }
    .show-category { font-size:.6rem; letter-spacing:.1em; text-transform:uppercase; color:var(--text-muted); background:rgba(255,255,255,.04); border:1px solid var(--border); padding:.18rem .55rem; border-radius:20px; }
    .show-title { font-family:var(--font-display); font-size:1.55rem; font-weight:900; letter-spacing:.04em; line-height:1.2; margin-bottom:1.25rem; }

    /* PRECIO */
    .price-row {
      display:flex; align-items:center; gap:1.25rem;
      padding:1rem 1.25rem;
      background:rgba(0,212,255,.05); border:1px solid rgba(0,212,255,.12);
      border-radius:var(--radius);
    }
    .product-price { display:flex; align-items:baseline; gap:.2rem; flex:1; }
    .price-symbol  { font-family:var(--font-display); font-size:.8rem; color:var(--accent); font-weight:700; }
    .price-amount  { font-family:var(--font-display); font-size:2rem; font-weight:900; text-shadow:0 0 24px rgba(0,212,255,.3); }
    .price-cents   { font-family:var(--font-display); font-size:.8rem; color:var(--text-muted); }
    .price-usd     { font-size:.65rem; color:var(--text-muted); letter-spacing:.1em; text-transform:uppercase; font-family:var(--font-display); margin-left:auto; }

    /* SECCIÓN LABEL */
    .show-section-label {
      display:flex; align-items:center; gap:.6rem;
      font-family:var(--font-display); font-size:.7rem; font-weight:700;
      letter-spacing:.12em; text-transform:uppercase; color:var(--text-dim); margin-bottom:1rem;
    }
    .show-section-label::before { content:''; width:3px; height:14px; display:block; border-radius:2px; background:linear-gradient(to bottom,var(--accent),var(--accent-alt)); }

    .show-desc { font-size:.98rem; color:var(--text-dim); line-height:1.7; font-weight:300; }

    /* FICHA */
    .specs-grid { display:grid; grid-template-columns:1fr 1fr; gap:.6rem; }
    .spec-item { display:flex; flex-direction:column; gap:.2rem; padding:.75rem 1rem; background:var(--surface-2); border:1px solid var(--border); border-radius:var(--radius); transition:border-color var(--transition); }
    .spec-item:hover { border-color:rgba(0,212,255,.2); }
    .spec-label { font-size:.58rem; font-family:var(--font-display); letter-spacing:.12em; text-transform:uppercase; color:var(--text-muted); }
    .spec-value { font-size:.92rem; color:var(--text); font-weight:600; }
    .spec-value.hi { color:var(--accent); font-family:var(--font-display); font-size:.8rem; }

    /* BOTONES */
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
    .btn-edit    { background:rgba(124,58,237,.12); border:1px solid rgba(124,58,237,.3); color:#a78bfa; }
    .btn-edit:hover { background:rgba(124,58,237,.2); border-color:rgba(124,58,237,.55); box-shadow:0 8px 22px rgba(124,58,237,.22); transform:translateY(-2px); }
    .btn-danger  { background:rgba(255,71,87,.08); border:1px solid rgba(255,71,87,.25); color:var(--danger); }
    .btn-danger:hover { background:rgba(255,71,87,.15); border-color:rgba(255,71,87,.5); box-shadow:0 8px 22px rgba(255,71,87,.2); transform:translateY(-2px); }

    .show-actions { display:flex; gap:1rem; flex-wrap:wrap; }
    .show-actions .btn { flex:1; justify-content:center; min-width:110px; }

    /* MODAL */
    .modal-backdrop { display:none; position:fixed; inset:0; z-index:200; background:rgba(0,0,0,.65); backdrop-filter:blur(6px); align-items:center; justify-content:center; }
    .modal-backdrop.open { display:flex; }
    .modal { background:var(--surface); border:1px solid var(--border); border-radius:14px; padding:2rem 2.25rem; max-width:420px; width:90%; position:relative; box-shadow:0 32px 80px rgba(0,0,0,.7); animation:card-in .3s cubic-bezier(.4,0,.2,1) both; }
    .modal::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--danger),transparent); }
    .modal-icon  { font-size:2.4rem; text-align:center; display:block; margin-bottom:.75rem; }
    .modal-title { font-family:var(--font-display); font-size:1rem; font-weight:700; letter-spacing:.06em; text-align:center; margin-bottom:.5rem; }
    .modal-body  { font-size:.88rem; color:var(--text-dim); text-align:center; line-height:1.6; margin-bottom:1.5rem; }
    .modal-actions { display:flex; gap:.75rem; }
    .modal-actions .btn { flex:1; justify-content:center; }

    /* FOOTER */
    .footer { position:relative; z-index:1; text-align:center; font-size:.68rem; color:var(--text-muted); letter-spacing:.12em; opacity:.55; padding:1.5rem 0 2rem; }
    .sep { margin:0 .5rem; color:var(--accent); }

    @media (max-width:768px) {
      .show-grid  { grid-template-columns:1fr; }
      .specs-grid { grid-template-columns:1fr; }
      .show-card  { padding:1.25rem; }
      .navbar { padding:0 1.25rem; }
      .nav-links, .nav-divider { display:none; }
    }
  </style>
</head>
<body>

  <div class="bg-grid"></div>
  <div class="glow-orb glow-1"></div>
  <div class="glow-orb glow-2"></div>

  <!-- CONTENIDO -->
  <div class="container">

    <!-- BREADCRUMB -->
    <nav class="breadcrumb">
      <a href="#">🕹️ Catálogo</a>
      <span class="breadcrumb-sep">›</span>
      <span class="breadcrumb-current">DualSense Edge</span>
    </nav>

    <!-- GRID -->
    <div class="show-grid">

      <!-- IMAGEN -->
      <div class="show-img-panel">
        <div class="show-img-wrap">
          <img
            src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=800&q=80"
            alt="DualSense Edge"
          />
          <div class="show-img-gradient"></div>
        </div>
        <span class="status-badge active">
          <span class="status-dot"></span>
          Activo
        </span>
      </div>

      <!-- INFO -->
      <div class="show-info-panel">

        <!-- Nombre + Precio -->
        <div class="show-card">
          <div class="show-meta">
            <span class="show-brand">Sony</span>
            <span class="show-category">Control</span>
          </div>
          <h1 class="show-title">DualSense Edge</h1>
          <div class="price-row">
            <div class="product-price">
              <span class="price-symbol">$</span>
              <span class="price-amount">199</span>
              <span class="price-cents">.99</span>
            </div>
            <span class="price-usd">USD</span>
          </div>
        </div>

        <!-- Descripción -->
        <div class="show-card sm">
          <div class="show-section-label">Descripción</div>
          <p class="show-desc">Control inalámbrico de alto rendimiento para PS5 con gatillos adaptativos intercambiables, retroalimentación háptica avanzada y perfiles personalizables. Incluye módulos de stick intercambiables, botones traseros programables y puerto USB-C integrado para carga rápida.</p>
        </div>

        <!-- Ficha técnica -->
        <div class="show-card sm">
          <div class="show-section-label">Ficha Técnica</div>
          <div class="specs-grid">
            <div class="spec-item">
              <span class="spec-label">ID Producto</span>
              <span class="spec-value hi">#0001</span>
            </div>
            <div class="spec-item">
              <span class="spec-label">Marca</span>
              <span class="spec-value">Sony</span>
            </div>
            <div class="spec-item">
              <span class="spec-label">Categoría</span>
              <span class="spec-value">Control</span>
            </div>
            <div class="spec-item">
              <span class="spec-label">Estado</span>
              <span class="spec-value" style="color:var(--success)">Activo</span>
            </div>
            <div class="spec-item">
              <span class="spec-label">Creado</span>
              <span class="spec-value">12 Ene 2026</span>
            </div>
            <div class="spec-item">
              <span class="spec-label">Actualizado</span>
              <span class="spec-value">17 Feb 2026</span>
            </div>
          </div>
        </div>

        <!-- Acciones -->
        <div class="show-actions">
          <a href="#" class="btn btn-ghost">← Volver</a>
          <a href="#" class="btn btn-edit">✏️ Editar</a>
          <button class="btn btn-danger" onclick="openDeleteModal()">🗑️ Eliminar</button>
        </div>

      </div>
    </div>

  </div>


  <!-- MODAL ELIMINAR -->
  <div class="modal-backdrop" id="deleteModal">
    <div class="modal">
      <span class="modal-icon">⚠️</span>
      <h2 class="modal-title">Eliminar Producto</h2>
      <p class="modal-body">
        ¿Estás seguro de eliminar
        <strong style="color:var(--text)">DualSense Edge</strong>?
        Esta acción no se puede deshacer.
      </p>
      <div class="modal-actions">
        <button class="btn btn-ghost" onclick="closeDeleteModal()">Cancelar</button>
        <button class="btn btn-danger" style="flex:1;justify-content:center;">Eliminar</button>
      </div>
    </div>
  </div>

  <script>
    const modal = document.getElementById('deleteModal');
    function openDeleteModal()  { modal.classList.add('open'); }
    function closeDeleteModal() { modal.classList.remove('open'); }
    modal.addEventListener('click', e => { if (e.target === modal) closeDeleteModal(); });
  </script>

@endsection

