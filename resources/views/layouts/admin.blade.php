<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin – @yield('title', 'Panel')</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --bg: #f1f5f9;
      --sidebar-bg: #1e293b;
      --sidebar-hover: #334155;
      --sidebar-active: #3b82f6;
      --header-bg: #ffffff;
      --card-bg: #ffffff;
      --text: #1e293b;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --accent: #3b82f6;
      --danger: #ef4444;
      --success: #22c55e;
      --sidebar-w: 250px;
      --header-h: 60px;
      --font: 'Inter', sans-serif;
    }
    body { font-family: var(--font); background: var(--bg); color: var(--text); min-height: 100vh; }

    /* SIDEBAR */
    .sidebar {
      position: fixed; top: 0; left: 0; bottom: 0;
      width: var(--sidebar-w);
      background: var(--sidebar-bg);
      display: flex; flex-direction: column;
      z-index: 100; overflow-y: auto;
    }
    .sidebar-logo {
      padding: 1.5rem 1.25rem;
      border-bottom: 1px solid rgba(255,255,255,.08);
      display: flex; align-items: center; gap: .75rem;
    }
    .sidebar-logo-icon {
      width: 36px; height: 36px; border-radius: 8px;
      background: var(--accent); display: flex;
      align-items: center; justify-content: center;
      font-size: 1.1rem;
    }
    .sidebar-logo-text {
      font-size: .95rem; font-weight: 700;
      color: #fff; letter-spacing: .02em;
    }
    .sidebar-logo-sub { font-size: .7rem; color: #94a3b8; margin-top: .1rem; }

    .sidebar-section { padding: 1.25rem 1rem .5rem; font-size: .65rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; color: #475569; }

    .sidebar-nav { list-style: none; padding: 0 .75rem; }
    .sidebar-nav li a {
      display: flex; align-items: center; gap: .75rem;
      padding: .65rem .85rem; border-radius: 8px;
      color: #94a3b8; text-decoration: none;
      font-size: .875rem; font-weight: 500;
      transition: all .2s ease; margin-bottom: .15rem;
    }
    .sidebar-nav li a:hover { background: var(--sidebar-hover); color: #fff; }
    .sidebar-nav li a.active { background: var(--accent); color: #fff; }
    .sidebar-nav li a .nav-icon { font-size: 1rem; width: 20px; text-align: center; }

    .sidebar-footer {
      margin-top: auto; padding: 1rem .75rem;
      border-top: 1px solid rgba(255,255,255,.08);
    }
    .sidebar-footer a {
      display: flex; align-items: center; gap: .75rem;
      padding: .65rem .85rem; border-radius: 8px;
      color: #94a3b8; text-decoration: none;
      font-size: .875rem; font-weight: 500;
      transition: all .2s ease;
    }
    .sidebar-footer a:hover { background: rgba(239,68,68,.15); color: #ef4444; }

    /* HEADER */
    .admin-header {
      position: fixed; top: 0;
      left: var(--sidebar-w); right: 0;
      height: var(--header-h);
      background: var(--header-bg);
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center;
      justify-content: space-between;
      padding: 0 1.5rem; z-index: 99;
    }
    .header-title { font-size: 1rem; font-weight: 600; color: var(--text); }
    .header-right { display: flex; align-items: center; gap: 1rem; }
    .header-badge {
      background: var(--accent); color: #fff;
      font-size: .7rem; font-weight: 600;
      padding: .25rem .75rem; border-radius: 20px;
    }

    /* MAIN */
    .admin-main {
      margin-left: var(--sidebar-w);
      padding-top: var(--header-h);
      min-height: 100vh;
    }
    .admin-content { padding: 2rem; }

    /* CARDS */
    .admin-card {
      background: var(--card-bg);
      border: 1px solid var(--border);
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }
    .admin-card-title {
      font-size: 1rem; font-weight: 600;
      margin-bottom: 1.25rem;
      padding-bottom: .75rem;
      border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: .5rem;
    }

    /* STATS */
    .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px,1fr)); gap: 1rem; margin-bottom: 2rem; }
    .stat-card { background: var(--card-bg); border: 1px solid var(--border); border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
    .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0; }
    .stat-icon.blue   { background: rgba(59,130,246,.12); }
    .stat-icon.green  { background: rgba(34,197,94,.12); }
    .stat-icon.purple { background: rgba(168,85,247,.12); }
    .stat-icon.orange { background: rgba(249,115,22,.12); }
    .stat-value { font-size: 1.5rem; font-weight: 700; line-height: 1; }
    .stat-label { font-size: .78rem; color: var(--text-muted); margin-top: .2rem; }

    /* BTN */
    .btn { display: inline-flex; align-items: center; gap: .4rem; padding: .55rem 1.1rem; border-radius: 8px; font-size: .825rem; font-weight: 500; cursor: pointer; text-decoration: none; border: none; transition: all .2s ease; }
    .btn-primary { background: var(--accent); color: #fff; }
    .btn-primary:hover { background: #2563eb; }
    .btn-danger { background: rgba(239,68,68,.1); color: var(--danger); border: 1px solid rgba(239,68,68,.2); }
    .btn-danger:hover { background: var(--danger); color: #fff; }
    .btn-sm { padding: .35rem .75rem; font-size: .775rem; }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="sidebar-logo-icon">⚡</div>
    <div>
      <div class="sidebar-logo-text">GameStore</div>
      <div class="sidebar-logo-sub">Panel Admin</div>
    </div>
  </div>

  <p class="sidebar-section">Principal</p>
  <ul class="sidebar-nav">
    <li><a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}"><span class="nav-icon">📊</span> Dashboard</a></li>
    <li><a href="{{ route('product.index') }}" class="{{ request()->is('product*') ? 'active' : '' }}"><span class="nav-icon">🕹️</span> Productos</a></li>
    <li><a href="/admin/categories" class="{{ request()->is('admin/categories*') ? 'active' : '' }}"><span class="nav-icon">📂</span> Categorías</a></li>
  </ul>

  <p class="sidebar-section">Tienda</p>
  <ul class="sidebar-nav">
    <li><a href="/"><span class="nav-icon">🏠</span> Ver tienda</a></li>
  </ul>

  <div class="sidebar-footer">
    <a href="/"><span>🚪</span> Salir del admin</a>
  </div>
</aside>

<!-- HEADER -->
<header class="admin-header">
  <span class="header-title">@yield('title', 'Dashboard')</span>
  <div class="header-right">
    <span class="header-badge">Admin</span>
  </div>
</header>

<!-- CONTENIDO -->
<main class="admin-main">
  <div class="admin-content">
    @yield('content')
  </div>
</main>

</body>
</html>