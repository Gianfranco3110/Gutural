@extends('layouts.admin')

@section('title', 'Posts')
@section('page-title', 'Posts del Blog')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-xs text-[#6b6b6b] tracking-wider">{{ $posts->total() }} posts en total</p>
    <a href="{{ route('admin.posts.create') }}" class="btn-primary text-xs">+ Nuevo Post</a>
</div>

@if(session('success'))
<div class="mb-6 px-4 py-3 bg-[#1a2a1a] border border-[#2a5a2a] text-[#a0e0a0] text-xs tracking-wider">
    {{ session('success') }}
</div>
@endif

@if($posts->isEmpty())
<div class="bg-[#0f0f0f] border border-[#2a2a2a] px-6 py-16 text-center">
    <p class="text-[#6b6b6b] text-xs tracking-wider mb-4">No hay posts registrados.</p>
    <a href="{{ route('admin.posts.create') }}" class="btn-outline text-xs">Crear primer post</a>
</div>
@else
<div class="bg-[#0f0f0f] border border-[#2a2a2a] overflow-hidden">
    {{-- Desktop table --}}
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b border-[#2a2a2a]">
                    <th class="text-left px-4 py-3 font-bold tracking-widest uppercase text-[#6b6b6b] w-16">Img</th>
                    <th class="text-left px-4 py-3 font-bold tracking-widest uppercase text-[#6b6b6b]">Título</th>
                    <th class="text-left px-4 py-3 font-bold tracking-widest uppercase text-[#6b6b6b]">Colección</th>
                    <th class="text-left px-4 py-3 font-bold tracking-widest uppercase text-[#6b6b6b]">Fecha</th>
                    <th class="text-left px-4 py-3 font-bold tracking-widest uppercase text-[#6b6b6b]">Estado</th>
                    <th class="text-right px-4 py-3 font-bold tracking-widest uppercase text-[#6b6b6b]">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-[#2a2a2a]">
                @foreach($posts as $post)
                <tr class="hover:bg-[#1a1a1a] transition-colors">
                    <td class="px-4 py-3">
                        <div class="w-10 h-10 bg-[#1a1a1a] overflow-hidden flex-shrink-0">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="h-4 w-4 text-[#6b6b6b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <p class="font-bold tracking-wider text-[#f5f5f5]">{{ $post->title }}</p>
                        @if($post->subtitle)
                        <p class="text-[#6b6b6b] tracking-wider">{{ $post->subtitle }}</p>
                        @endif
                    </td>
                    <td class="px-4 py-3 capitalize text-[#c0c0c0] tracking-wider">{{ $post->collection }}</td>
                    <td class="px-4 py-3 text-[#c0c0c0] tracking-wider whitespace-nowrap">
                        {{ $post->published_at->format('d M Y') }}
                    </td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.posts.toggle', $post) }}" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-[10px] font-bold tracking-widest uppercase px-2 py-1 border transition-colors
                                           {{ $post->is_published
                                              ? 'border-[#2a5a2a] text-[#a0e0a0] hover:bg-[#2a5a2a]'
                                              : 'border-[#5a2a2a] text-[#e0a0a0] hover:bg-[#5a2a2a]' }}">
                                {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-3">
                            <a href="{{ route('admin.posts.edit', $post) }}"
                               class="text-[#6b6b6b] hover:text-white transition-colors" title="Editar">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                  onsubmit="return confirm('¿Eliminar \"{{ addslashes($post->title) }}\"? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-[#6b6b6b] hover:text-[#e0a0a0] transition-colors" title="Eliminar">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Mobile cards --}}
    <div class="sm:hidden divide-y divide-[#2a2a2a]">
        @foreach($posts as $post)
        <div class="p-4 flex items-center gap-3">
            <div class="w-14 h-14 bg-[#1a1a1a] flex-shrink-0 overflow-hidden">
                @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover" />
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold tracking-wider truncate">{{ $post->title }}</p>
                <p class="text-xs text-[#6b6b6b] capitalize">{{ $post->collection }} · {{ $post->published_at->format('d M Y') }}</p>
            </div>
            <a href="{{ route('admin.posts.edit', $post) }}" class="text-[#6b6b6b] hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="mt-6">
    {{ $posts->links() }}
</div>
@endif
@endsection
