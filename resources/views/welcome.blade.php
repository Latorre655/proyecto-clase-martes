<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>GameStore – Inicio</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg:#060912; --surface:#0d1120; --surface-2:#111827;
      --border:#1e2d4a; --accent:#00d4ff; --accent-alt:#7c3aed;
      --text:#e2e8f0; --text-muted:#64748b; --text-dim:#94a3b8;
      --font-display:'Orbitron',monospace; --font-body:'Rajdhani',sans-serif;
      --radius:6px; --nav-h:68px; --transition:0.25s cubic-bezier(0.4,0,0.2,1);
    }
    body { background:var(--bg); color:var(--text); font-family:var(--font-body); min-height:100vh; overflow-x:hidden; }

    /* FONDO */
    .bg-grid { position:fixed; inset:0; background-image:linear-gradient(rgba(0,212,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(0,212,255,0.03) 1px,transparent 1px); background-size:40px 40px; pointer-events:none; z-index:0; }
    .glow-orb { position:fixed; border-radius:50%; filter:blur(100px); pointer-events:none; z-index:0; animation:orb-float 8s ease-in-out infinite; }
    .glow-1 { width:500px; height:500px; background:rgba(0,212,255,0.08); top:-150px; right:-100px; }
    .glow-2 { width:400px; height:400px; background:rgba(124,58,237,0.1); bottom:-100px; left:-100px; animation-delay:4s; }
    @keyframes orb-float { 0%,100%{transform:translateY(0) scale(1);} 50%{transform:translateY(-30px) scale(1.05);} }

    /* NAVBAR */
    .navbar { position:fixed; top:0; left:0; right:0; height:var(--nav-h); background:rgba(6,9,18,0.88); backdrop-filter:blur(18px); border-bottom:1px solid var(--border); z-index:100; display:flex; align-items:center; padding:0 2rem; gap:2rem; }
    .navbar::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--accent),var(--accent-alt),transparent); opacity:.7; }
    .nav-logo { display:flex; align-items:center; gap:.45rem; font-family:var(--font-display); font-size:1.15rem; font-weight:900; letter-spacing:.1em; text-transform:uppercase; text-decoration:none; color:var(--text); }
    .nav-accent { color:var(--accent); text-shadow:0 0 18px var(--accent); }
    .nav-links { display:flex; align-items:center; gap:.25rem; list-style:none; flex:1; }
    .nav-links a { display:flex; align-items:center; gap:.4rem; font-family:var(--font-display); font-size:.6rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-decoration:none; color:var(--text-muted); padding:.5rem .85rem; border-radius:var(--radius); border:1px solid transparent; transition:all var(--transition); }
    .nav-links a:hover { color:var(--text); background:rgba(255,255,255,.04); border-color:var(--border); }
    .nav-links a.active { color:var(--accent); background:rgba(0,212,255,.08); border-color:rgba(0,212,255,.2); }
    .nav-cta { display:flex; align-items:center; gap:.45rem; font-family:var(--font-display); font-size:.6rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-decoration:none; color:#fff; padding:.55rem 1.1rem; border-radius:var(--radius); background:linear-gradient(135deg,#006b82,#00a8cc); border:1px solid rgba(0,212,255,.35); box-shadow:0 4px 18px rgba(0,212,255,.2); transition:all var(--transition); }
    .nav-cta:hover { transform:translateY(-1px); box-shadow:0 8px 28px rgba(0,212,255,.35); }

    /* HERO */
    .hero { position:relative; z-index:1; min-height:100vh; display:flex; align-items:center; justify-content:center; text-align:center; padding:calc(var(--nav-h) + 4rem) 2rem 4rem; }
    .hero-content { max-width:750px; }
    .hero-badge { display:inline-flex; align-items:center; gap:.5rem; font-family:var(--font-display); font-size:.6rem; letter-spacing:.2em; text-transform:uppercase; color:var(--accent); border:1px solid rgba(0,212,255,.25); background:rgba(0,212,255,.06); padding:.4rem 1rem; border-radius:20px; margin-bottom:2rem; }
    .hero-title { font-family:var(--font-display); font-size:clamp(2rem,5vw,3.8rem); font-weight:900; letter-spacing:.06em; text-transform:uppercase; line-height:1.1; margin-bottom:1.5rem; }
    .hero-title .accent { color:var(--accent); text-shadow:0 0 30px var(--accent),0 0 60px rgba(0,212,255,.3); }
    .hero-sub { font-size:1.1rem; color:var(--text-dim); font-weight:300; line-height:1.7; margin-bottom:2.5rem; }
    .hero-actions { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }
    .btn-primary { font-family:var(--font-display); font-size:.68rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-decoration:none; padding:.85rem 2rem; border-radius:var(--radius); background:linear-gradient(135deg,#006b82,#00a8cc); color:#fff; border:1px solid rgba(0,212,255,.35); box-shadow:0 4px 20px rgba(0,212,255,.25); transition:all var(--transition); }
    .btn-primary:hover { transform:translateY(-2px); box-shadow:0 10px 32px rgba(0,212,255,.4); }
    .btn-outline { font-family:var(--font-display); font-size:.68rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; text-decoration:none; padding:.85rem 2rem; border-radius:var(--radius); background:transparent; color:var(--text); border:1px solid var(--border); transition:all var(--transition); }
    .btn-outline:hover { border-color:var(--accent); color:var(--accent); }

    /* PRODUCTOS */
    .section { position:relative; z-index:1; padding:4rem 2rem; max-width:1200px; margin:0 auto; }
    .section-header { text-align:center; margin-bottom:3rem; }
    .section-header h2 { font-family:var(--font-display); font-size:1.5rem; font-weight:900; letter-spacing:.1em; text-transform:uppercase; margin-bottom:.5rem; }
    .section-header p { color:var(--text-muted); font-size:.9rem; letter-spacing:.1em; }
    .catalog-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:1.5rem; }

    .product-card { background:var(--surface); border:1px solid var(--border); border-radius:14px; overflow:hidden; display:flex; flex-direction:column; transition:transform var(--transition),box-shadow var(--transition),border-color var(--transition); box-shadow:0 8px 32px rgba(0,0,0,.4); animation:card-in .5s cubic-bezier(.4,0,.2,1) both; }
    @keyframes card-in { from{opacity:0;transform:translateY(22px);} to{opacity:1;transform:translateY(0);} }
    .product-card:nth-child(1){animation-delay:.05s} .product-card:nth-child(2){animation-delay:.10s} .product-card:nth-child(3){animation-delay:.15s}
    .product-card:nth-child(4){animation-delay:.20s} .product-card:nth-child(5){animation-delay:.25s} .product-card:nth-child(6){animation-delay:.30s}
    .product-card::before { content:''; position:absolute; top:0; left:0; right:0; height:2px; background:linear-gradient(90deg,transparent,var(--accent),var(--accent-alt),transparent); opacity:0; transition:opacity var(--transition); }
    .product-card { position:relative; }
    .product-card:hover::before { opacity:.75; }
    .product-card:hover { transform:translateY(-6px); border-color:rgba(0,212,255,.28); box-shadow:0 20px 50px rgba(0,0,0,.55),0 0 0 1px rgba(0,212,255,.12); }

    .product-img-wrap { width:100%; aspect-ratio:16/10; background:var(--surface-2); overflow:hidden; }
    .product-img-wrap img { width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
    .product-card:hover .product-img-wrap img { transform:scale(1.07); }

    .product-body { padding:1.25rem; display:flex; flex-direction:column; gap:.5rem; flex:1; }
    .product-name { font-family:var(--font-display); font-size:.9rem; font-weight:700; letter-spacing:.03em; }
    .product-desc { font-size:.88rem; color:var(--text-dim); line-height:1.5; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }

    .product-footer { padding:.9rem 1.25rem 1.25rem; display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border); }
    .price-amount { font-family:var(--font-display); font-size:1.2rem; font-weight:900; color:var(--accent); text-shadow:0 0 20px rgba(0,212,255,.2); }
    .btn-buy { font-family:var(--font-display); font-size:.62rem; font-weight:700; letter-spacing:.12em; text-transform:uppercase; padding:.55rem 1.1rem; border-radius:var(--radius); background:linear-gradient(135deg,#006b82,#00a8cc); color:#fff; border:1px solid rgba(0,212,255,.3); cursor:pointer; transition:all var(--transition); text-decoration:none; }
    .btn-buy:hover { transform:translateY(-1px); box-shadow:0 8px 22px rgba(0,212,255,.28); }

    .footer { position:relative; z-index:1; text-align:center; font-size:.68rem; color:var(--text-muted); letter-spacing:.12em; opacity:.55; padding:1.5rem 0 2rem; }
    .sep { margin:0 .5rem; color:var(--accent); }
  </style>
</head>
<body>

<div class="bg-grid"></div>
<div class="glow-orb glow-1"></div>
<div class="glow-orb glow-2"></div>

<!-- NAVBAR -->
<nav class="navbar">
  <a class="nav-logo" href="/">⚡ GAME<span class="nav-accent">STORE</span></a>
  <ul class="nav-links">
    <li><a href="/" class="active">🏠 Inicio</a></li>
    <li><a href="{{ route('product.index') }}">🕹️ Catálogo</a></li>
  </ul>
  <a href="{{ route('product.create') }}" class="nav-cta">＋ Nuevo Producto</a>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-content">
    <div class="hero-badge">⚡ Bienvenido a GameStore</div>
    <h1 class="hero-title">
      Los mejores<br><span class="accent">productos gaming</span><br>al mejor precio
    </h1>
    <p class="hero-sub">Descubre nuestra colección de productos seleccionados para gamers exigentes.</p>
    <div class="hero-actions">
      <a href="{{ route('product.index') }}" class="btn-primary">🕹️ Ver catálogo completo</a>
      <a href="{{ route('product.create') }}" class="btn-outline">＋ Agregar producto</a>
    </div>
  </div>
</section>

<!-- PRODUCTOS DESTACADOS -->
<section class="section">
  <div class="section-header">
    <h2>⭐ Productos <span style="color:var(--accent)">Destacados</span></h2>
    <p>Los últimos productos agregados a la tienda</p>
  </div>

  <div class="catalog-grid">
    @forelse($products as $product)
    <div class="product-card">
      <div class="product-img-wrap">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
      </div>
      <div class="product-body">
        <div class="product-name">{{ $product->name }}</div>
        <div class="product-desc">{{ Str::limit($product->descripcion, 80) }}</div>
      </div>
      <div class="product-footer">
        <span class="price-amount">${{ number_format($product->price, 2) }}</span>
        <a href="/product/{{ $product->id }}" class="btn-buy">Ver detalle →</a>
      </div>
    </div>
    @empty
    <p style="color:var(--text-muted); grid-column:1/-1; text-align:center; padding:3rem;">
      No hay productos aún. <a href="{{ route('product.create') }}" style="color:var(--accent)">¡Agrega el primero!</a>
    </p>
    @endforelse
  </div>
</section>

<footer class="footer">
  © 2026 GameStore<span class="sep">|</span>Todos los derechos reservados
</footer>

</body>
</html>