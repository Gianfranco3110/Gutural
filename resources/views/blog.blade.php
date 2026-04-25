@extends('layouts.app')

@section('title', 'Blog')

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
    <div class="relative z-10 flex-1 grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center px-4 sm:px-8 lg:px-16">
        {{-- Izquierda --}}
        <div class="hidden lg:flex justify-start pl-4">
            <p class="text-[#0a0a0a] tracking-[0.25em] uppercase leading-[1.15]">
                <span class="font-bold text-[13px]">GUTURAL</span><br/>
                <span class="font-normal text-[9px]">ESTD. 2026</span>
            </p>
        </div>
        {{-- Centro --}}
        <div class="flex flex-col items-center justify-center text-center lg:col-start-2">
            <img src="{{ asset('images/blog/Guts3d.png') }}" alt="Gutural mascot" class="max-h-[450px] sm:max-h-[550px] lg:max-h-[600px] w-auto drop-shadow-2xl" />
            <h1 class="font-display text-6xl sm:text-8xl text-[#0a0a0a] leading-none -mt-20">BLOG</h1>
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

{{-- BLOG POSTS GRID --}}
<section class="py-16 sm:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($posts->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($posts as $blogPost)
                <a href="{{ route('blog.show', $blogPost->slug) }}#post-content" class="bg-white overflow-hidden group cursor-pointer hover:shadow-2xl transition-shadow duration-300 block">
                    {{-- Imagen sin título superpuesto --}}
                    <div class="relative aspect-[4/3] overflow-hidden bg-[#0a0a0a]">
                        @if($blogPost->image)
                            <img src="{{ asset('storage/' . $blogPost->image) }}"
                                 alt="{{ $blogPost->title }}"
                                 class="w-full h-full object-cover" />
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="h-12 w-12 text-[#3a3a3a]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Contenido --}}
                    <div class="p-6 bg-white relative">
                        {{-- Fecha --}}
                        <p class="text-[#0a0a0a] text-[11px] tracking-wide">
                            {{ $blogPost->published_at->format('d F Y') }}
                        </p>

                        {{-- Título con subtítulo --}}
                        <h4 class="font-display text-4xl sm:text-5xl text-[#515151] leading-none mb-4 -mt-2">
                            {{ strtoupper($blogPost->title) }}
                            @if($blogPost->subtitle)
                                <span class="block font-sans font-bold text-sm text-[#515151] tracking-[0.2em] -mt-1">{{ strtoupper($blogPost->subtitle) }}</span>
                            @endif
                        </h4>

                        {{-- Excerpt --}}
                        @if($blogPost->excerpt)
                        <p class="text-[#2a2a2a] text-xs leading-relaxed mb-6 text-justify">
                            {{ $blogPost->excerpt }}
                        </p>
                        @endif

                        {{-- CTA con mascota --}}
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-2 text-[10px] font-bold tracking-wider uppercase text-[#515151] group-hover:text-[#4a4a4a] transition-colors">
                                LEER MAS...
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M10 8l4 4-4 4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                            <img src="{{ asset('images/blog/GUTS-BLOG.png') }}" alt="Guts" class="h-16 w-auto opacity-80" />
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Paginación --}}
            @if($posts->hasPages())
            <div class="flex justify-center">
                <div class="flex items-center gap-2">
                    {{-- Previous --}}
                    @if($posts->onFirstPage())
                        <span class="px-4 py-2 text-xs font-bold text-[#6b6b6b] cursor-not-allowed">ANTERIOR</span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" 
                           class="px-4 py-2 text-xs font-bold text-[#0a0a0a] hover:text-white hover:bg-[#0a0a0a] border border-[#0a0a0a] transition-colors">
                            ANTERIOR
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach(range(1, $posts->lastPage()) as $page)
                        @if($page == $posts->currentPage())
                            <span class="px-4 py-2 text-xs font-bold bg-[#0a0a0a] text-white border border-[#0a0a0a]">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $posts->url($page) }}" 
                               class="px-4 py-2 text-xs font-bold text-[#0a0a0a] hover:text-white hover:bg-[#0a0a0a] border border-[#0a0a0a] transition-colors">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" 
                           class="px-4 py-2 text-xs font-bold text-[#0a0a0a] hover:text-white hover:bg-[#0a0a0a] border border-[#0a0a0a] transition-colors">
                            SIGUIENTE
                        </a>
                    @else
                        <span class="px-4 py-2 text-xs font-bold text-[#6b6b6b] cursor-not-allowed">SIGUIENTE</span>
                    @endif
                </div>
            </div>
            @endif

        @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <svg class="h-20 w-20 text-[#c0c0c0] mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <h3 class="font-display text-2xl text-[#2a2a2a] mb-3">No hay artículos publicados</h3>
                    <p class="text-[#6b6b6b] text-sm tracking-wide">Próximamente nuevos artículos.</p>
                </div>
            </div>
        @endif

    </div>
</section>

{{-- SECCIÓN RESILENCE --}}
<section id="post-content" class="relative overflow-hidden">
    {{-- Imagen completa arriba (DINÁMICA) --}}
    <div class="relative h-[250px] sm:h-[350px] lg:h-[450px]">
        @if(!empty($post) && $post->banner_image)
            <img src="{{ asset($post->banner_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover" />
        @else
            <img src="{{ asset('images/blog/IMAGEN-BLOG.png') }}" alt="Blog" class="w-full h-full object-cover" />
        @endif
    </div>

    {{-- Contenido completo abajo (DINÁMICO) --}}
    <div class="bg-[#c8d2d8] px-6 py-10 sm:px-12 sm:py-14 lg:px-20 lg:py-16">
        <div class="max-w-5xl mx-auto">
            @if(!empty($post))
                {{-- Contenido dinámico del post seleccionado --}}
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-[#4a4b4f] mb-3 leading-none">{{ strtoupper($post->title) }}</h2>
                @if($post->subtitle)
                <p class="text-[#515151] text-sm sm:text-base font-bold mb-6 uppercase tracking-[0.2em]">{{ strtoupper($post->subtitle) }}</p>
                @endif
                
                <div class="text-[#2a2a2a] text-sm sm:text-base leading-relaxed text-justify space-y-4">
                    {!! nl2br(e($post->content)) !!}
                </div>
            @else
                {{-- Contenido por defecto (RESILENCE) --}}
                <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl text-[#4a4b4f] mb-3 leading-none">RESILENCE</h2>
                <p class="text-[#515151] text-sm sm:text-base font-bold mb-6 uppercase tracking-[0.2em]">(RESILENCIA)</p>
                
                <p class="text-[#2a2a2a] text-sm sm:text-base leading-relaxed mb-6 text-justify">
                    Es la capacidad de una persona para atravesar momentos difíciles, adaptarse y salir transformada, no necesariamente intacta, sino más consciente, más preparada y, muchas veces, más fuerte emocionalmente.
                </p>

                <div class="space-y-5 text-[#2a2a2a] text-sm sm:text-base leading-relaxed text-justify">
                    <div>
                        <p class="font-bold mb-2">Una persona resiliente:</p>
                        <p>No evita el dolor, lo enfrenta, no niega las caídas, aprende de ellas, no vuelve a ser la misma después de una crisis... se reconstruye mejor.</p>
                    </div>

                    <div>
                        <p class="font-bold mb-3">Desde el comportamiento humano, la resilencia implica tres cosas clave:</p>
                        <p class="mb-3"><span class="font-bold">- 1. Interpretación de la realidad:</span> No es lo que te pasa, sino cómo lo interpretas. Dos personas viven lo mismo, pero una se rompe y otra evoluciona.</p>
                        <p class="mb-3"><span class="font-bold">- 2. Regulación emocional:</span> Sentir miedo, tristeza o frustración es normal. La resilencia está en no quedarse atrapado ahí.</p>
                        <p><span class="font-bold">- 3. Acción adaptativa:</span> El resiliente no se queda paralizado: ajusta, aprende, intenta otra vez.</p>
                    </div>

                    <p class="italic">
                        En pocas palabras: La resilencia es el arte de doblarse sin quebrarse... y volver con más claridad de quién eres y de lo que eres capaz.
                    </p>

                    <p class="font-bold text-base sm:text-lg mt-6">
                        Lo más importante: no es un talento con el que naces o no, es una habilidad que se construye, golpe a golpe, decisión a decisión.
                    </p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- SECCIÓN ARTÍCULOS DEL BLOG --}}
<section class="py-16 sm:py-20 bg-[#c8d2d8]">
    <div class="max-w-7xl mx-auto px-6 sm:px-10">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-8">
            @foreach($featuredPosts as $featuredPost)
            <div class="flex flex-col">
                <a href="{{ route('blog.show', $featuredPost) }}#post-content" class="bg-[#0a0a0a] aspect-[4/3] flex items-center justify-center mb-4 overflow-hidden group">
                    @if($featuredPost->image)
                        <img src="{{ asset('storage/' . $featuredPost->image) }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    @else
                        <img src="{{ asset('images/blog/miniatura-' . $featuredPost->slug . '.png') }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    @endif
                </a>
                <a href="{{ route('blog.show', $featuredPost) }}#post-content" class="self-start text-[10px] font-bold tracking-[0.2em] uppercase text-[#515151] border-2 border-[#515151] rounded-md bg-transparent px-6 py-2 hover:bg-[#515151] hover:text-white transition-colors">
                    LEER ARTICULO
                </a>
            </div>
            @endforeach
        </div>

        {{-- Paginación --}}
        <div class="flex justify-center items-center gap-3">
            <button class="w-6 h-6 rounded-full bg-[#0a0a0a] hover:bg-[#2a2a2a] transition-colors" aria-label="Página anterior"></button>
            <button class="w-6 h-6 rounded-full bg-[#6a6a6a] hover:bg-[#4a4a4a] transition-colors" aria-label="Página 2"></button>
            <button class="w-6 h-6 rounded-full bg-[#6a6a6a] hover:bg-[#4a4a4a] transition-colors" aria-label="Página siguiente"></button>
        </div>
    </div>
</section>

@endsection
