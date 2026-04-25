@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
    {{-- Stat: Total products --}}
    <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6">
        <p class="text-[10px] font-bold tracking-widest uppercase text-white mb-2">Total Productos</p>
        <p class="text-4xl font-display tracking-wider text-[#a0e0a0]">{{ $totalProducts }}</p>
    </div>

    {{-- Stat: Active products --}}
    <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6">
        <p class="text-[10px] font-bold tracking-widest uppercase text-white mb-2">Productos Activos</p>
        <p class="text-4xl font-display tracking-wider text-[#a0e0a0]">{{ $activeProducts }}</p>
    </div>

    {{-- Quick action --}}
    <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 flex flex-col justify-between">
        <p class="text-[10px] font-bold tracking-widest uppercase text-white mb-4">Acción Rápida</p>
        <a href="{{ route('admin.products.create') }}" class="btn-primary text-center text-xs">
            + Nuevo Producto
        </a>
    </div>
</div>

{{-- Stats Posts --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    {{-- Stat: Total posts --}}
    <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6">
        <p class="text-[10px] font-bold tracking-widest uppercase text-white mb-2">Total Posts</p>
        <p class="text-4xl font-display tracking-wider text-[#a0e0a0]">{{ $totalPosts }}</p>
    </div>

    {{-- Stat: Published posts --}}
    <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6">
        <p class="text-[10px] font-bold tracking-widest uppercase text-white mb-2">Posts Publicados</p>
        <p class="text-4xl font-display tracking-wider text-[#a0e0a0]">{{ $publishedPosts }}</p>
    </div>

    {{-- Quick action posts --}}
    <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 flex flex-col justify-between">
        <p class="text-[10px] font-bold tracking-widest uppercase text-white mb-4">Acción Rápida</p>
        <a href="{{ route('admin.posts.create') }}" class="btn-primary text-center text-xs">
            + Nuevo Post
        </a>
    </div>
</div>
@endsection
