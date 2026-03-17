@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon blue">🕹️</div>
    <div>
      <div class="stat-value">{{ $totalProducts }}</div>
      <div class="stat-label">Productos</div>
    </div>
  </div>
  <div class="stat-card">
    <div class="stat-icon green">📂</div>
    <div>
      <div class="stat-value">{{ $totalCategories }}</div>
      <div class="stat-label">Categorías</div>
    </div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card-title">⚡ Bienvenido al panel de administración</div>
  <p style="color:#64748b; font-size:.9rem;">Gestiona productos, categorías y más desde aquí.</p>
</div>

@endsection