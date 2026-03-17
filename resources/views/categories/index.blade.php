@extends('layouts.admin')
@section('title', 'Categorías')

@section('content')

@if(session('success'))
<div style="background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.3); color:#16a34a; padding:.75rem 1rem; border-radius:8px; margin-bottom:1.5rem; font-size:.875rem;">
    ✅ {{ session('success') }}
</div>
@endif

<div class="admin-card">
    <div class="admin-card-title">
        📂 Categorías
        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm" style="margin-left:auto;">+ Nueva Categoría</a>
    </div>

    <table style="width:100%; border-collapse:collapse; font-size:.875rem;">
        <thead>
            <tr style="border-bottom:2px solid var(--border);">
                <th style="padding:.75rem 1rem; text-align:left; color:var(--text-muted); font-weight:600;">#</th>
                <th style="padding:.75rem 1rem; text-align:left; color:var(--text-muted); font-weight:600;">Nombre</th>
                <th style="padding:.75rem 1rem; text-align:left; color:var(--text-muted); font-weight:600;">Descripción</th>
                <th style="padding:.75rem 1rem; text-align:left; color:var(--text-muted); font-weight:600;">Creada</th>
                <th style="padding:.75rem 1rem; text-align:center; color:var(--text-muted); font-weight:600;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr style="border-bottom:1px solid var(--border); transition:background .15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                <td style="padding:.75rem 1rem; color:var(--text-muted);">{{ $category->id }}</td>
                <td style="padding:.75rem 1rem; font-weight:600;">{{ $category->name }}</td>
                <td style="padding:.75rem 1rem; color:var(--text-muted);">{{ Str::limit($category->descripcion, 50) ?? '—' }}</td>
                <td style="padding:.75rem 1rem; color:var(--text-muted);">{{ $category->created_at->format('d M Y') }}</td>
                <td style="padding:.75rem 1rem; text-align:center;">
                    <div style="display:flex; gap:.5rem; justify-content:center;">
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm" style="background:rgba(59,130,246,.1); color:#3b82f6; border:1px solid rgba(59,130,246,.2);">✏️ Editar</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta categoría?')">🗑️ Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding:2rem; text-align:center; color:var(--text-muted);">No hay categorías aún.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:1rem;">
        {{ $categories->links('pagination::simple-bootstrap-4') }}
    </div>
</div>

@endsection