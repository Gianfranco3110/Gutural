@extends('layouts.admin')

@section('title', 'Nuevo Producto')
@section('page-title', 'Nuevo Producto')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        @include('admin.products._form', ['product' => null])

        <div class="flex items-center justify-end gap-4 mt-6">
            <a href="{{ route('admin.products.index') }}" class="btn-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-primary text-xs">Crear Producto</button>
        </div>
    </form>
</div>
@endsection
