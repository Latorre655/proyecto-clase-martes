@extends('layouts.app')
@section('content')

  <div class="container">

    <!-- HEADER -->
    <header class="header">
      <div class="logo">
        <span class="logo-icon">⚡</span>
        GAME<span class="accent">STORE</span>
      </div>
      <p class="header-sub">Panel de Administración · Productos Gaming</p>
    </header>

    <!-- TOP BAR -->
    <div class="top-bar">
      <div class="top-left">
        <div class="section-title">
          <span class="section-icon">🕹️</span>
          <h2>Catálogo</h2>
          <span class="section-count" id="countLabel">6 items</span>
        </div>
        <div class="filter-bar">
          <button class="filter-btn active" onclick="filterCards(this,'all')">Todos</button>
          <button class="filter-btn" onclick="filterCards(this,'active')">Activos</button>
          <button class="filter-btn" onclick="filterCards(this,'inactive')">Inactivos</button>
        </div>
      </div>
      <a href="gamestore.html" class="btn-add">
        <span class="btn-add-shimmer"></span>
        ＋ Agregar Producto
      </a>
    </div>

    <!-- GRID -->
    <div class="catalog-grid" id="catalog">

      <div class="product-card" data-status="active">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1606144042614-b2417e99c4e3?w=600&q=80" alt="DualSense Edge"/>
          <div class="product-img-overlay"></div>
          <span class="status-badge active"><span class="status-dot"></span>Activo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">Sony</span><span class="product-category">Control</span></div>
          <h3 class="product-name">DualSense Edge</h3>
          <p class="product-desc">Control inalámbrico de alto rendimiento para PS5 con gatillos adaptativos intercambiables, retroalimentación háptica avanzada y perfiles personalizables.</p>
        </div>
        <div class="product-footer">
          <div class="product-price"><span class="price-symbol">$</span><span class="price-amount">199</span><span class="price-cents">.99</span></div>
          <button class="btn-buy">🛒 Agregar</button>
        </div>
      </div>

      <div class="product-card" data-status="active">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1593642632559-0c6d3fc62b89?w=600&q=80" alt="BlackWidow V4 Pro"/>
          <div class="product-img-overlay"></div>
          <span class="status-badge active"><span class="status-dot"></span>Activo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">Razer</span><span class="product-category">Teclado</span></div>
          <h3 class="product-name">BlackWidow V4 Pro</h3>
          <p class="product-desc">Teclado mecánico con switches Razer Green, iluminación RGB Chroma por tecla, reposamuñecas magnético y conectividad inalámbrica HyperSpeed.</p>
        </div>
        <div class="product-footer">
          <div class="product-price"><span class="price-symbol">$</span><span class="price-amount">229</span><span class="price-cents">.99</span></div>
          <button class="btn-buy">🛒 Agregar</button>
        </div>
      </div>

      <div class="product-card inactive" data-status="inactive">
        <div class="dim-overlay"></div>
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=600&q=80" alt="Cloud Alpha Wireless"/>
          <div class="product-img-overlay"></div>
          <span class="status-badge inactive"><span class="status-dot"></span>Inactivo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">HyperX</span><span class="product-category">Audífonos</span></div>
          <h3 class="product-name">Cloud Alpha Wireless</h3>
          <p class="product-desc">Auriculares gaming con autonomía de 300 horas, audio dual chamber, micrófono desmontable con cancelación de ruido y drivers de 50mm personalizados.</p>
        </div>
        <div class="product-footer">
          <div class="product-price"><span class="price-symbol">$</span><span class="price-amount">149</span><span class="price-cents">.99</span></div>
          <button class="btn-buy" disabled>Sin stock</button>
        </div>
      </div>

      <div class="product-card" data-status="active">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1527814050087-3793815479db?w=600&q=80" alt="G Pro X Superlight"/>
          <div class="product-img-overlay"></div>
          <span class="status-badge active"><span class="status-dot"></span>Activo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">Logitech</span><span class="product-category">Mouse</span></div>
          <h3 class="product-name">G Pro X Superlight 2</h3>
          <p class="product-desc">Mouse inalámbrico ultra ligero de 60g con sensor HERO 2 de 32,000 DPI, batería de 95 horas y switches LIGHTFORCE híbridos.</p>
        </div>
        <div class="product-footer">
          <div class="product-price"><span class="price-symbol">$</span><span class="price-amount">159</span><span class="price-cents">.99</span></div>
          <button class="btn-buy">🛒 Agregar</button>
        </div>
      </div>

      <div class="product-card" data-status="active">
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1616588589676-62b3bd4ff6d2?w=600&q=80" alt="Monitor ROG"/>
          <div class="product-img-overlay"></div>
          <span class="status-badge active"><span class="status-dot"></span>Activo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">ASUS ROG</span><span class="product-category">Monitor</span></div>
          <h3 class="product-name">Swift Pro PG248QP</h3>
          <p class="product-desc">Monitor gaming 24" Full HD a 540Hz, tiempo de respuesta 0.2ms, compatible G-Sync y panel TN optimizado para competitivo.</p>
        </div>
        <div class="product-footer">
          <div class="product-price"><span class="price-symbol">$</span><span class="price-amount">899</span><span class="price-cents">.00</span></div>
          <button class="btn-buy">🛒 Agregar</button>
        </div>
      </div>

      <div class="product-card inactive" data-status="inactive">
        <div class="dim-overlay"></div>
        <div class="product-img-wrap">
          <img src="https://images.unsplash.com/photo-1585792180666-f7347c490ee2?w=600&q=80" alt="Silla Corsair"/>
          <div class="product-img-overlay"></div>
          <span class="status-badge inactive"><span class="status-dot"></span>Inactivo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">Corsair</span><span class="product-category">Silla</span></div>
          <h3 class="product-name">TC200 Leatherette</h3>
          <p class="product-desc">Silla gaming ergonómica con espuma de alta densidad, brazos 4D, reclinación hasta 180°, almohada lumbar de memoria y base de aluminio reforzado.</p>
        </div>
        <div class="product-footer">
          <div class="product-price"><span class="price-symbol">$</span><span class="price-amount">349</span><span class="price-cents">.99</span></div>
          <button class="btn-buy" disabled>Sin stock</button>
        </div>
      </div>

    </div>

    <!-- FOOTER -->
    <footer class="footer">
      © 2025 GameStore<span class="sep">|</span>Todos los derechos reservados
    </footer>

  </div>

@endsection
