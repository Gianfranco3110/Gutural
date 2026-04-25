@extends('layouts.admin')

@section('title', 'Editar: ' . $product->name)
@section('page-title', 'Editar Producto')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" novalidate id="edit-form">
        @csrf @method('PUT')
        @include('admin.products._form', ['product' => $product])

        <div class="flex items-center justify-between mt-6">
            <button type="button" onclick="if(confirm('¿Eliminar este producto? Esta acción no se puede deshacer.')) { document.getElementById('delete-form').submit(); }"
                    class="text-xs text-[#e0a0a0] hover:underline tracking-wider">
                Eliminar producto
            </button>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.products.index') }}" class="btn-outline text-xs">Cancelar</a>
                <button type="submit" class="btn-primary text-xs">Guardar cambios</button>
            </div>
        </div>
    </form>

    {{-- Separate delete form --}}
    <form id="delete-form" method="POST" action="{{ route('admin.products.destroy', $product) }}" class="hidden">
        @csrf @method('DELETE')
    </form>
</div>
@endsection
