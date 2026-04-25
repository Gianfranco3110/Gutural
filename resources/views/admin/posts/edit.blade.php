@extends('layouts.admin')

@section('title', 'Editar Post')
@section('page-title', 'Editar Post')

@section('content')
<div class="max-w-3xl mx-auto">
    @if(session('success'))
    <div class="mb-6 px-4 py-3 bg-[#1a2a1a] border border-[#2a5a2a] text-[#a0e0a0] text-xs tracking-wider">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        @include('admin.posts._form')

        <div class="flex items-center justify-between mt-6">
            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                  onsubmit="return confirm('¿Eliminar este post? Esta acción no se puede deshacer.')">
                @csrf @method('DELETE')
                <button type="submit" class="text-[10px] font-bold tracking-widest uppercase text-[#e0a0a0] border border-[#5a2a2a] px-4 py-2.5 hover:bg-[#5a2a2a] transition-colors">
                    Eliminar post
                </button>
            </form>

            <div class="flex items-center gap-4">
                <a href="{{ route('admin.posts.index') }}" class="btn-outline text-xs">Cancelar</a>
                <button type="submit" class="btn-primary text-xs">Guardar Cambios</button>
            </div>
        </div>
    </form>
</div>
@endsection
