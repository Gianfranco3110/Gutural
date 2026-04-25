@extends('layouts.app')

@section('title', 'Tienda — Gutural')

@push('head')
<style>
    body {
        background-image: url('{{ asset('images/background-desktop.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: scroll;
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<section class="relative min-h-screen flex flex-col overflow-hidden">
    <div class="relative z-10 flex-1 grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center px-4 sm:px-8 lg:px-16 pt-20">
        {{-- Izquierda --}}
        <div class="hidden lg:flex justify-start pl-4">
            <p class="text-[#0a0a0a] tracking-[0.25em] uppercase leading-[1.15]">
                <span class="font-bold text-[13px]">GUTURAL</span><br/>
                <span class="font-normal text-[9px]">ESTD. 2026</span>
            </p>
        </div>
        {{-- Centro --}}
        <div class="flex flex-col items-center justify-center text-center lg:col-start-2">
            <img src="{{ asset('images/shop/guts-shop.png') }}" alt="Gutural Shop" class="max-h-[450px] sm:max-h-[550px] lg:max-h-[600px] w-auto drop-shadow-2xl" />
            <h1 class="font-display text-6xl sm:text-8xl text-[#0a0a0a] leading-none -mt-6">SHOP</h1>
        </div>
        {{-- Derecha --}}
        <div class="hidden md:flex justify-end pr-4">
            <p class="text-[#0a0a0a] tracking-[0.2em] uppercase leading-[1.15] text-right">
                <span class="font-bold text-[13px]">NO HAY MAL</span><br/>
                <span class="font-normal text-[9px]">QUE DURE</span><br/>
                <span class="font-normal text-[9px]">1,000 AÑOS</span><br/>
                <span class="font-bold text-[13px]">NI CUERPO</span><br/>
                <span class="font-normal text-[9px]">QUE LO RESISTA</span>
            </p>
        </div>
    </div>
</section>

{{-- SECCIÓN CATEGORÍAS --}}
<section class="py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- T-SHIRTS --}}
            <a href="{{ route('shop.index', ['tipo' => 'tshirt']) }}" class="group relative overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="relative aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('images/shop/vista-previa-tshirts.png') }}" alt="T-Shirts" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="font-display text-2xl sm:text-3xl text-[#0a0a0a] leading-none mb-1">T-SHIRTS</h3>
                        <p class="text-[#0a0a0a] text-xs tracking-wide">6 PRODUCTOS</p>
                    </div>
                </div>
            </a>

            {{-- PANTS --}}
            <a href="{{ route('shop.index', ['tipo' => 'mono']) }}" class="group relative overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="relative aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('images/shop/vista-previa-pants.png') }}" alt="Pants" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="font-display text-2xl sm:text-3xl text-[#0a0a0a] leading-none mb-1">PANTS</h3>
                        <p class="text-[#0a0a0a] text-xs tracking-wide">6 PRODUCTOS</p>
                    </div>
                </div>
            </a>

            {{-- ACCESORIES --}}
            <a href="{{ route('shop.index', ['tipo' => 'accesorio']) }}" class="group relative overflow-hidden hover:shadow-2xl transition-shadow duration-300">
                <div class="relative aspect-[4/5] overflow-hidden">
                    <img src="{{ asset('images/shop/vista-previa-accesorios.png') }}" alt="Accesories" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                    <div class="absolute bottom-0 left-0 right-0 p-4">
                        <h3 class="font-display text-2xl sm:text-3xl text-[#0a0a0a] leading-none mb-1">ACCESORIES</h3>
                        <p class="text-[#0a0a0a] text-xs tracking-wide">12 PRODUCTOS</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- SECCIÓN PRODUCTOS --}}
<section class="py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">
        {{-- Header con filtros --}}
        <div class="mb-12">
            <h2 class="font-display text-6xl sm:text-7xl lg:text-8xl text-[#0a0a0a] mb-0 leading-none">SHOP</h2>
            <div class="flex flex-wrap gap-4 text-xl sm:text-2xl -mt-2">
                <a href="{{ route('shop.index') }}" class="font-display text-[#0a0a0a] hover:underline {{ !request()->has('tipo') ? 'underline' : '' }}">T-SHIRTS</a>
                <span class="text-[#0a0a0a]">/</span>
                <a href="{{ route('shop.index', ['tipo' => 'mono']) }}" class="font-display text-[#0a0a0a] hover:underline {{ request('tipo') === 'mono' ? 'underline' : '' }}">PANTS</a>
                <span class="text-[#0a0a0a]">/</span>
                <a href="{{ route('shop.index', ['tipo' => 'accesorio']) }}" class="font-display text-[#0a0a0a] hover:underline {{ request('tipo') === 'accesorio' ? 'underline' : '' }}">ACCESORIES</a>
            </div>
        </div>

        {{-- Grid de productos --}}
        @if($products->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
            @foreach($products as $product)
            <a href="{{ route('shop.show', $product) }}" class="block group shadow-lg hover:shadow-2xl transition-shadow duration-300 bg-transparent overflow-hidden">
                {{-- Imagen del producto --}}
                <div class="relative aspect-square overflow-hidden mb-4">
                    @if($product->images->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover" />
                    @else
                        <img src="{{ asset('images/background-producto.jpg') }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover" />
                    @endif
                    
                    {{-- Indicadores de imagen --}}
                    @if($product->images->count() > 1)
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                        @foreach($product->images as $index => $image)
                        <span class="w-2 h-2 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"></span>
                        @endforeach
                    </div>
                    @endif
                </div>

                {{-- Contenido con padding --}}
                <div class="px-4 pb-4">
                    {{-- Título --}}
                    <h3 class="font-sans text-2xl sm:text-3xl text-[#0a0a0a] font-bold mb-3 leading-none">{{ strtoupper($product->name) }}</h3>

                    {{-- Descripción --}}
                    @if($product->description)
                    <div class="mb-4 h-20">
                        <p class="text-[#0a0a0a] text-xs leading-relaxed text-justify line-clamp-4 font-medium">
                            {{ $product->description }}
                        </p>
                    </div>
                    @endif

                    {{-- Precio y carrito --}}
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-[10px] font-bold tracking-wider uppercase text-[#0a0a0a] border-2 border-[#0a0a0a] rounded-md px-4 py-2 group-hover:bg-[#0a0a0a] group-hover:text-white transition-colors inline-block">
                                VER MÁS...
                            </span>
                            @if($product->original_price && $product->original_price > $product->price)
                            <span class="text-[#6b6b6b] text-sm line-through">REF: ${{ number_format($product->original_price, 0) }}</span>
                            @endif
                            <span class="text-[#0a0a0a] text-xl font-bold">${{ number_format($product->price, 0) }}</span>
                        </div>
                        <button type="button" onclick="event.preventDefault(); event.stopPropagation();" class="border-2 border-[#6b6b6b] text-[#6b6b6b] rounded-md p-2 hover:bg-[#6b6b6b] hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-[#6b6b6b] text-sm">No hay productos disponibles.</p>
        </div>
        @endif
    </div>
</section>

@endsection
