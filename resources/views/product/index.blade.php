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

    <br>
    {{ $milista->links('pagination::simple-default') }}
    <br>


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


        @foreach ($milista as $product)


      <div class="product-card" data-status="active" onclick="window.location='/product/{{ $product->id }}'" style="cursor:pointer;">
        <div class="product-img-wrap">
          <img src="{{ asset ("storage/".$product -> image) }}" alt=""/>
          <div class="product-img-overlay"></div>
          <span class="status-badge active"><span class="status-dot"></span>Activo</span>
        </div>
        <div class="product-body">
          <div class="product-meta"><span class="product-brand">Sony</span><span class="product-category">Control</span></div>
          <h3 class="product-name">{{ $product -> name }}</h3>
          <p class="product-desc">{{ $product->descripcion }}</p>
        </div>
        <div class="product-footer">
        <div class="product-price">
          <span class="price-symbol">$</span>
          <span class="price-amount">{{ $product->price }}</span>
        </div>
        <div style="display:flex; gap:.5rem; align-items:center;">
          <button class="btn-buy" onclick="event.stopPropagation()" style="padding:.55rem .96rem;">🛒</button>
          <form action="{{ route('product.destroy', $product) }}"
                method="post"
                onclick="event.stopPropagation()">
            @csrf
            @method('delete')
            <button type="submit"
                    class="btn-buy"
                    style="background:rgba(255,71,87,.15);border-color:rgba(255,71,87,.3);color:#ff4757;">
              🗑️
            </button>
          </form>
        </div>
</div>
      </div>
      @endforeach


@endsection
