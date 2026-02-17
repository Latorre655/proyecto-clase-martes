@extends('layouts.app')
@section('content')

  <div class="container">

    <header class="header">
      <div class="logo">
        <span class="logo-icon">⚡</span>
        GAME<span class="accent">STORE</span>
      </div>
      <p class="header-sub">Panel de Administración · Productos Gaming</p>
    </header>

    <main class="card">
      <div class="card-header">
        <div class="card-title">
          <span class="card-icon">🎮</span>
          <h1>Nuevo Producto</h1>
          <span class="card-badge">Admin</span>
        </div>
        <div class="card-line"></div>
      </div>

      <form class="form" novalidate>

        <!-- Nombre -->
        <div class="form-group">
          <label for="nombre" class="label">
            <span class="label-tag">01</span> Nombre del Producto
          </label>
          <div class="input-wrapper">
            <input
              type="text"
              id="nombre"
              name="nombre"
              class="input"
              placeholder="Ej: Control DualSense Edge Blanco"
              required
            />
            <div class="input-border"></div>
          </div>
        </div>

        <!-- Precio + Marca -->
        <div class="form-row">
          <div class="form-group">
            <label for="precio" class="label">
              <span class="label-tag">02</span> Precio (USD)
            </label>
            <div class="input-wrapper">
              <span class="input-prefix">$</span>
              <input
                type="number"
                id="precio"
                name="precio"
                class="input has-prefix"
                placeholder="0.00"
                min="0"
                step="0.01"
                required
              />
              <div class="input-border"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="marca" class="label">
              <span class="label-tag">03</span> Marca
            </label>
            <div class="input-wrapper">
              <select id="marca" name="marca" class="input select" required>
                <option value="" disabled selected>Selecciona una marca</option>
                <option>Sony</option>
                <option>Microsoft</option>
                <option>Nintendo</option>
                <option>Razer</option>
                <option>Logitech</option>
                <option>SteelSeries</option>
                <option>HyperX</option>
                <option>Corsair</option>
                <option>ASUS ROG</option>
                <option>Turtle Beach</option>
                <option>Otra</option>
              </select>
              <div class="input-border"></div>
            </div>
          </div>
        </div>

        <div class="divider"><span>✦</span></div>

        <!-- Descripción -->
        <div class="form-group">
          <label for="descripcion" class="label">
            <span class="label-tag">04</span> Descripción
          </label>
          <div class="input-wrapper">
            <textarea
              id="descripcion"
              name="descripcion"
              class="input textarea"
              placeholder="Describe las características, especificaciones y detalles del producto..."
              rows="5"
              required
            ></textarea>
            <div class="input-border"></div>
          </div>
          <span class="char-hint">Describe al menos las especificaciones principales del producto</span>
        </div>

        <!-- Acciones -->
        <div class="form-actions">
          <button type="reset" class="btn btn-ghost">✕ Limpiar</button>
          <button type="submit" class="btn btn-primary" id="submitBtn">
            <span class="btn-shimmer"></span>
            <span id="btnText">⚡ Publicar Producto</span>
          </button>
        </div>

      </form>
    </main>

    <footer class="footer">
      © 2026 GameStore<span class="sep">|</span>Todos los derechos reservados
    </footer>

  </div>


@endsection

