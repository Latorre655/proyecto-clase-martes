@extends('layouts.app')
@section('title', 'Carrito')
@section('content')

<div class="container">

  <div class="page-header">
    <h1 class="page-title">
      <span class="page-title-icon">🛒</span>
      MI <span class="accent">CARRITO</span>
    </h1>
    <p class="page-subtitle">Resumen de tu compra</p>
  </div>

  @if(session('success'))
  <div style="background:rgba(0,201,122,.1); border:1px solid rgba(0,201,122,.3); color:#00c97a; padding:.75rem 1rem; border-radius:8px; font-size:.875rem;">
    ✅ {{ session('success') }}
  </div>
  @endif

  @if($items->isEmpty())
    <div style="text-align:center; padding:4rem 0; color:var(--text-muted);">
      <div style="font-size:3rem; margin-bottom:1rem;">🛒</div>
      <p style="font-family:var(--font-display); font-size:1rem; letter-spacing:.1em;">TU CARRITO ESTÁ VACÍO</p>
      <a href="{{ route('product.index') }}" class="btn btn-primary" style="margin-top:1.5rem; display:inline-flex;">
        <span class="btn-shimmer"></span>
        🎮 Ver Catálogo
      </a>
    </div>
  @else
    <div style="display:grid; grid-template-columns:1fr 320px; gap:2rem; align-items:start;">

      <!-- Lista de productos -->
      <div style="display:flex; flex-direction:column; gap:1rem;">
        @foreach($items as $item)
        <div style="background:var(--surface); border:1px solid var(--border); border-radius:14px; padding:1.25rem; display:flex; align-items:center; gap:1.25rem;">
          
          @if($item->product->imagen)
          <img src="{{ asset('storage/' . $item->product->imagen) }}" style="width:80px; height:80px; object-fit:cover; border-radius:8px; border:1px solid var(--border);">
          @else
          <div style="width:80px; height:80px; background:var(--surface-2); border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:2rem;">🎮</div>
          @endif

          <div style="flex:1;">
            <p style="font-family:var(--font-display); font-size:.85rem; font-weight:700; letter-spacing:.05em;">{{ $item->product->name }}</p>
            <p style="color:var(--accent); font-family:var(--font-display); font-size:.9rem; margin-top:.25rem;">${{ number_format($item->product->price, 2) }}</p>
          </div>

          <div style="display:flex; align-items:center; gap:.5rem;">
            <span style="font-size:.75rem; color:var(--text-muted); font-family:var(--font-display);">x{{ $item->quantity }}</span>
          </div>

          <form action="{{ route('cart.remove', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:rgba(255,71,87,.1); border:1px solid rgba(255,71,87,.2); color:#ff4757; padding:.4rem .75rem; border-radius:6px; cursor:pointer; font-size:.75rem;">🗑️</button>
          </form>
        </div>
        @endforeach
      </div>

      <!-- Resumen -->
      <div style="background:var(--surface); border:1px solid var(--border); border-radius:14px; padding:1.5rem; position:sticky; top:calc(var(--nav-h) + 1rem);">
        <h2 style="font-family:var(--font-display); font-size:.9rem; font-weight:700; letter-spacing:.1em; margin-bottom:1.25rem; text-transform:uppercase;">Resumen</h2>
        
        <div style="display:flex; justify-content:space-between; margin-bottom:.75rem; font-size:.9rem; color:var(--text-muted);">
          <span>Productos ({{ $items->count() }})</span>
          <span>${{ number_format($total, 2) }}</span>
        </div>

        <div style="height:1px; background:var(--border); margin:1rem 0;"></div>

        <div style="display:flex; justify-content:space-between; font-family:var(--font-display); font-size:1.1rem; font-weight:900; margin-bottom:1.5rem;">
          <span>TOTAL</span>
          <span style="color:var(--accent); text-shadow:0 0 20px rgba(0,212,255,.3)">${{ number_format($total, 2) }}</span>
        </div>

        <button class="btn btn-primary" style="width:100%; justify-content:center;">
          <span class="btn-shimmer"></span>
          ⚡ Finalizar Compra
        </button>

        <form action="{{ route('cart.clear') }}" method="POST" style="margin-top:.75rem;">
          @csrf
          <button type="submit" class="btn btn-ghost" style="width:100%; justify-content:center;" onclick="return confirm('¿Vaciar carrito?')">
            🗑️ Vaciar carrito
          </button>
        </form>

        <a href="{{ route('product.index') }}" style="display:block; text-align:center; margin-top:.75rem; font-size:.75rem; color:var(--text-muted); text-decoration:none;">← Seguir comprando</a>
      </div>

    </div>
  @endif

</div>

@endsection