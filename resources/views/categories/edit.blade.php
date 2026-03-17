@extends('layouts.admin')
@section('title', 'Editar Categoría')

@section('content')
<div class="admin-card">
    <div class="admin-card-title">✏️ Editar Categoría</div>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="display:flex; flex-direction:column; gap:1.25rem; max-width:500px;">
            <div>
                <label style="display:block; font-size:.825rem; font-weight:500; margin-bottom:.4rem;">Nombre *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    style="width:100%; padding:.65rem .9rem; border:1px solid var(--border); border-radius:8px; font-size:.9rem; outline:none;">
                @error('name')<p style="color:var(--danger); font-size:.78rem; margin-top:.3rem;">{{ $message }}</p>@enderror
            </div>
            <div>
                <label style="display:block; font-size:.825rem; font-weight:500; margin-bottom:.4rem;">Descripción</label>
                <textarea name="descripcion" rows="3"
                    style="width:100%; padding:.65rem .9rem; border:1px solid var(--border); border-radius:8px; font-size:.9rem; outline:none; resize:vertical;">{{ old('descripcion', $category->descripcion) }}</textarea>
                @error('descripcion')<p style="color:var(--danger); font-size:.78rem; margin-top:.3rem;">{{ $message }}</p>@enderror
            </div>
            <div style="display:flex; gap:.75rem;">
                <a href="{{ route('categories.index') }}" class="btn btn-sm" style="border:1px solid var(--border); color:var(--text-muted);">← Cancelar</a>
                <button type="submit" class="btn btn-primary btn-sm">Actualizar Categoría</button>
            </div>
        </div>
    </form>
</div>
@endsection