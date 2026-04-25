@extends('layouts.admin')

@section('title', 'Nuevo Post')
@section('page-title', 'Nuevo Post')

@section('content')
<div class="max-w-3xl mx-auto">
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        @include('admin.posts._form', ['post' => null])

        <div class="flex items-center justify-end gap-4 mt-6">
            <a href="{{ route('admin.posts.index') }}" class="btn-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-primary text-xs">Crear Post</button>
        </div>
    </form>
</div>
@endsection
