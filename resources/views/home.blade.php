@extends('layouts.app')

@section('title', 'Gutural — Donde el Silencio Muere')

@section('content')

{{-- SECCIÓN 1 — HERO --}}
<section class="relative min-h-screen flex flex-col overflow-hidden"
    style="background-image: url('{{ asset('images/home/mujer pixelada home.png') }}'); background-size: contain; background-position: center center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-[#c8c8c8]/10"></div>
    <div class="relative z-10 flex-1 grid grid-cols-1 lg:grid-cols-[1fr_auto_1fr] items-center px-4 sm:px-8 lg:px-16 pt-14">
        {{-- Izquierda --}}
        <div class="hidden lg:flex justify-start pl-4">
            <p class="text-[#515151] tracking-[0.25em] uppercase leading-[1.15]">
                <span class="font-bold text-[13px]">GUTURAL</span><br/>
                <span class="font-normal text-[9px]">ESTD. 2026</span>
            </p>
        </div>
        {{-- Centro --}}
        <div class="flex flex-col items-center justify-center text-center lg:col-start-2">
            <img src="{{ asset('images/home/logo titulo seccion 2 home.png') }}" alt="Gutural" class="h-10 sm:h-14 md:h-16 w-auto mb-4 drop-shadow-xl" />
            <p class="text-[#6b6b6b] text-sm sm:text-base md:text-lg tracking-[0.55em] uppercase font-normal">DONDE EL SILENCIO MUERE</p>
            <a href="{{ route('shop.index') }}" class="mt-8 inline-block bg-transparent text-[#515151] text-[11px] font-bold tracking-[0.25em] uppercase px-10 py-3 border-2 border-[#515151] rounded-md hover:bg-[#515151] hover:text-white transition-colors">IR A LA TIENDA !!!</a>
        </div>
        {{-- Derecha --}}
        <div class="hidden md:flex justify-end pr-4">
            <p class="text-[#515151] tracking-[0.2em] uppercase leading-[1.15] text-right">
                <span class="font-bold text-[13px]">NO HAY MAL</span><br/>
                <span class="font-normal text-[9px]">QUE DURE</span><br/>
                <span class="font-normal text-[9px]">1,000 AÑOS</span><br/>
                <span class="font-bold text-[13px]">NI CUERPO</span><br/>
                <span class="font-normal text-[9px]">QUE LO RESISTA</span>
            </p>
        </div>
    </div>
    <div class="relative z-10 w-full">
        <div class="w-full px-4 py-5 flex flex-wrap items-center justify-center gap-4 sm:gap-6">
            @foreach([
                ['slug'=>'resilencia', 'img'=>'titulo seccion 3 resilencia.png'],
                ['slug'=>'willpower',  'img'=>'titulo seccion 3 willpower.png'],
                ['slug'=>'gratitude',  'img'=>'titulo seccion 3 gratitude.png'],
            ] as $col)
            <img src="{{ asset('images/home/' . $col['img']) }}" alt="{{ $col['slug'] }}" class="h-5 sm:h-6 md:h-8 w-auto" />
            @endforeach
        </div>
    </div>
</section>

{{-- SECCIÓN 2 — MANIFIESTO --}}
<section id="concepto" class="py-24 md:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="flex justify-center md:justify-end order-2 md:order-1">
                <img src="{{ asset('images/home/guts seccion 2 home.png') }}" alt="Gutural mascot" class="max-h-[400px] sm:max-h-[500px] w-auto object-contain" />
            </div>
            <div class="order-1 md:order-2">
                <h2 class="font-display text-5xl sm:text-7xl text-[#0a0a0a] mb-8 leading-none">GUTURAL</h2>
                <div class="space-y-4 text-[#1a1a1a] text-sm leading-relaxed tracking-wide text-justify">
                    <p><strong>Gutural no nace por elección. Nace por necesidad. Nace de un pueblo humilde, trabajador, cansado de promesas vacías y verdades disfrazadas.</strong></p>
                    <p>De una <em>realidad</em> donde la represión se oculta bajo el nombre de democracia, pero se siente en la piel, en la calle y en la voz que intentaron silenciar. Gutural nace cuando callar deja de ser opción. Es la muerte del silencio, es el grito que se negó a desaparecer. Es la protesta que encontró en el arte su forma más honesta de existir.</p>
                    <div id="manifesto-extra" class="space-y-4 hidden">
                        <p>Aquí, la calle se convierte en lienzo, y cada prenda, en un acto de rebeldía. Porque entendimos algo esencial: las palabras tienen poder. Las tomamos, las hacemos nuestras, las cargamos de intención y las devolvemos al mundo convertidas en fuerza.</p>
                        <p>No son adornos, son declaraciones, son identidad, son historia, son resistencia visible. Vestir Gutural es más que llevar ropa: es portar un mensaje, es hablar sin pedir permiso, es representar al venezolano de calle, al que lucha, al que cae y se levanta.</p>
                        <p>Gutural no sigue tendencias, Gutural crea significados. Esto no es moda, es protesta, es arte.</p>
                    </div>
                    <p><em>Es poder hecho palabra... y palabra hecha para que la vistas.</em></p>
                </div>
                <button type="button" id="toggle-manifesto" class="mt-8 text-[11px] font-bold tracking-[0.25em] uppercase text-[#515151] border-2 border-[#515151] rounded-md px-10 py-3 hover:bg-[#515151] hover:text-white transition-colors">VER MAS...</button>
            </div>
        </div>
    </div>
</section>

{{-- SECCIÓN 3 — COLECCIONES --}}
<section id="colecciones" class="py-24 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
        $collections = [
            ['slug'=>'resilencia','title_img'=>'titulo seccion 3 resilencia.png','subtitle'=>'(RESILENCIA)','desc'=>'La capacidad del ser humano para atravesar momentos difíciles, adaptarse y salir transformado, no necesariamente intacto, sino más consciente, más preparado y, muchas veces, más fuerte emocionalmente.','extra_desc'=>'La Resilencia no es un talento con el que naces. Es una habilidad que se construye, golpe a golpe, decisión a decisión.'],
            ['slug'=>'willpower','title_img'=>'titulo seccion 3 willpower.png','subtitle'=>'(WILLPOWER)','desc'=>'La fuerza de voluntad como herramienta de vida. La capacidad de una persona para atravesar momentos difíciles con determinación, adaptarse y salir transformada con la convicción de alcanzar cualquier meta.'],
            ['slug'=>'gratitude','title_img'=>'titulo seccion 3 gratitude.png','subtitle'=>'(GRATITUD)','desc'=>'La gratitud como práctica diaria de crecimiento. Reconocer y apreciar lo positivo en nuestra vida, transformando la perspectiva y fortaleciendo el espíritu.'],
        ];
        @endphp

        @foreach($collections as $i => $collection)
        <div id="panel-{{ $collection['slug'] }}" class="collection-panel {{ $i!==0 ? 'hidden' : '' }}">
            <div class="text-center mb-6">
                <img src="{{ asset('images/home/' . $collection['title_img']) }}" alt="{{ $collection['slug'] }}" class="h-16 sm:h-24 w-auto mx-auto mb-4" />
                @if(!empty($collection['subtitle']))
                <p class="text-[#4a4a4a] text-base sm:text-lg md:text-xl tracking-[0.3em] uppercase font-medium">{{ $collection['subtitle'] }}</p>
                @endif
            </div>
            <p class="text-center text-sm text-[#2a2a2a] max-w-2xl mx-auto mb-6 leading-relaxed tracking-wide">{{ $collection['desc'] }}</p>
            @if(!empty($collection['extra_desc']))
            <p class="text-center text-sm text-[#2a2a2a] max-w-2xl mx-auto mb-6 leading-relaxed tracking-wide">{{ $collection['extra_desc'] }}</p>
            @endif
            <div class="flex justify-center gap-2 mb-10">
                @foreach($collections as $d => $c)
                <button type="button" onclick="switchCollection('{{ $c['slug'] }}')" data-dot="{{ $c['slug'] }}"
                    class="dot-btn w-2 h-2 rounded-full transition-colors {{ $d===$i ? 'bg-[#0a0a0a]' : 'bg-[#c0c0c0] hover:bg-[#6b6b6b]' }}"></button>
                @endforeach
            </div>
        </div>
        @endforeach

        @php
        $homeFixedProducts = [
            ['img' => 'shop/resilence/hombre espalda resilence.png', 'dot' => 1],
            ['img' => 'shop/resilence/resilence Detail.jpg', 'dot' => 2],
            ['img' => 'shop/resilence/mujer frente resilence.png', 'dot' => 3],
            ['img' => 'shop/resilence/ghost manekin resilence.png', 'dot' => 1],
        ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-12">
            @foreach($homeFixedProducts as $item)
            <div class="group relative overflow-hidden border border-[#8f8f8f] bg-[#b9b9bd]">
                <div class="aspect-[3/4] overflow-hidden">
                    <img src="{{ asset('images/' . $item['img']) }}" alt="Producto Gutural" class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500" />
                </div>

                <div class="absolute bottom-16 left-0 right-0 flex justify-center gap-3">
                    @for($i = 1; $i <= 3; $i++)
                    <span class="w-3 h-3 rounded-full border border-white {{ $item['dot'] === $i ? 'bg-white' : 'bg-transparent' }}"></span>
                    @endfor
                </div>

                <div class="absolute bottom-0 left-0 right-0 bg-[#4a4b4f]/95 border-t border-[#686a70] px-2 py-2">
                    <div class="grid grid-cols-[minmax(0,1fr)_auto] items-center gap-1.5">
                        <a href="{{ route('shop.index') }}" class="block text-center whitespace-nowrap rounded-md border border-[#e8e8e8] text-white text-[10px] font-extrabold tracking-[0.08em] py-1.5 px-2 hover:bg-white hover:text-[#1c1d20] transition-colors">VER EN TIENDA !!!</a>
                        <div class="text-right">
                            <img src="{{ asset('images/home/PANTS-TALLAS.png') }}" alt="Tallas pants" class="h-6 w-auto object-contain" />
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Botón Ver en Tienda --}}
        <div class="text-center">
            <a href="{{ route('shop.index') }}" class="inline-block bg-transparent text-[#515151] text-[11px] font-bold tracking-[0.25em] uppercase px-10 py-3 border-2 border-[#515151] rounded-md hover:bg-[#515151] hover:text-white transition-colors">VER EN TIENDA !!!</a>
        </div>
    </div>
</section>

{{-- SECCIÓN 4 — BLOG --}}
<section class="pt-24 md:pt-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="font-display text-4xl sm:text-6xl text-[#4f5257] text-center mb-14">LAS PALABRAS TIENEN PODER !!!</h2>

        @if($posts->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-12">
            @foreach($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="bg-white overflow-hidden group cursor-pointer block shadow-lg hover:shadow-2xl transition-shadow duration-300">
                {{-- Imagen --}}
                <div class="relative aspect-video overflow-hidden bg-[#0a0a0a]">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="{{ $post->title }}"
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
                    <p class="text-[#0a0a0a] text-[10px] tracking-wide mb-3">
                        {{ $post->published_at->format('d F Y') }}
                    </p>

                    {{-- Título con subtítulo --}}
                    <h4 class="font-display text-xl text-[#0a0a0a] leading-tight mb-4">
                        {{ strtoupper($post->title) }}
                        @if($post->subtitle)
                            <span class="block text-sm text-[#4a4a4a]">{{ strtoupper($post->subtitle) }}</span>
                        @endif
                    </h4>

                    {{-- Excerpt --}}
                    @if($post->excerpt)
                    <p class="text-[#2a2a2a] text-xs leading-relaxed mb-6 line-clamp-4">
                        {{ $post->excerpt }}
                    </p>
                    @endif

                    {{-- CTA con mascota --}}
                    <div class="flex items-end justify-between">
                        <span class="flex items-center gap-2 text-[10px] font-bold tracking-wider uppercase text-[#515151] group-hover:text-[#4a4a4a] transition-colors">
                            LEER MÁS...
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M10 8l4 4-4 4" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <img src="{{ asset('images/home/guts seccion 2 home.png') }}" alt="Guts" class="h-16 w-auto opacity-80" />
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 mb-12">
            <p class="text-[#6b6b6b] text-xs tracking-wider">Próximamente nuevos artículos.</p>
        </div>
        @endif

        <div class="text-center">
            <a href="{{ route('blog.index') }}" class="inline-block text-[11px] font-bold tracking-[0.25em] uppercase text-[#515151] border-2 border-[#515151] rounded-md px-10 py-3 hover:bg-[#515151] hover:text-white transition-colors">IR AL BLOG !!!</a>
        </div>
    </div>
</section>

{{-- SECCIÓN 5 — DE DONDE VENIMOS --}}
<section id="quienes-somos" class="pt-8 pb-16 sm:pb-20 bg-[#c8d2d8]">
    <div class="max-w-6xl mx-auto px-6 sm:px-10">
        <h2 class="font-display text-4xl sm:text-6xl text-[#4f5257] text-center leading-tight mb-8">DE DONDE VENIMOS,<br/>HACIA DONDE VAMOS !!!</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
            {{-- MISIÓN --}}
            <div>
                <img src="{{ asset('images/home/icono mission seccion 6.png') }}" alt="Misión" class="h-14 w-auto mb-4" />
                <h3 class="font-futura text-sm text-[#2a2a2a] font-bold mb-6">MISIÓN</h3>
                <div class="space-y-4 text-sm text-[#2a2a2a] leading-relaxed tracking-wide text-justify">
                    <p>Dar voz a quienes se negaron a callar, transformando palabras en piezas que comunican, empoderan, resisten y representan.</p>
                    <p>En <strong>Gutural</strong> creemos que las palabras tienen poder.</p>
                    <p>Las tomamos desde la calle, desde la presión, la verdad, desde nuestros corazones y las convertimos en ropa que no adorna, sino que declara, viste y empodera.</p>
                    <p>Nuestra misión es crear prendas que sean mensaje, identidad, empoderamiento y protesta visible, para quienes entienden que vestir también es una forma de hablar y sentir... sin pedir permiso.</p>
                </div>
            </div>

            {{-- VISIÓN --}}
            <div>
                <img src="{{ asset('images/home/icono vision seccion 6.png') }}" alt="Visión" class="h-14 w-auto mb-4" />
                <h3 class="font-futura text-sm text-[#2a2a2a] font-bold mb-6">VISIÓN</h3>
                <div class="space-y-4 text-sm text-[#2a2a2a] leading-relaxed tracking-wide text-justify">
                    <p>Convertir a <strong>Gutural</strong> en un símbolo global de expresión, donde la palabra se transforme en fuerza, poder y la ropa en una herramienta de impacto cultural imposible de oprimir.</p>
                    <p>Aspiramos a construir una marca que trascienda la moda, posicionándose como un movimiento donde cada pieza represente historia, resistencia y carácter.</p>
                    <p>Queremos que <strong>Gutural</strong> sea reconocido como la voz de quienes convierten la adversidad en identidad, demostrando que cuando las palabras nacen con intención... se vuelven poderosamente imposibles de ignorar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SECCIÓN 6 — PARTE DE NUESTRO EQUIPO --}}
<section class="pb-24 sm:pb-28 bg-[#c8d2d8]">
    <div class="max-w-6xl mx-auto px-6 sm:px-10">
        <h2 class="font-display text-4xl sm:text-6xl text-[#4f5257] text-center tracking-[0.08em] mb-16 sm:mb-24">PARTE DE NUESTRO EQUIPO</h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="flex items-center gap-6 sm:gap-8">
                <div class="w-36 h-36 sm:w-44 sm:h-44 rounded-full overflow-hidden shrink-0">
                    <img src="{{ asset('images/home/foto miniatura tairon vera seccion 6.png') }}" alt="Tairon Vera" class="w-full h-full object-cover" />
                </div>
                <div>
                    <h3 class="font-sans text-3xl sm:text-2xl text-[#0a0a0a] font-black leading-none mb-2 normal-case tracking-normal">Tairon Vera</h3>
                    <p class="text-[#6b6b6b] text-lg sm:text-base mb-4">C.E.O &amp; Founder</p>
                    <p class="text-[#2a2a2a] text-xs sm:text-sm leading-relaxed max-w-sm">Diseñador grafico con años de experiencia en identidad de marca y diseño web.</p>
                </div>
            </div>

            <div class="relative flex items-center gap-6 sm:gap-8 lg:pl-14">
                <div class="hidden lg:block absolute left-0 top-1/2 -translate-y-1/2 h-44 w-px bg-[#50535a]"></div>
                <div class="w-36 h-36 sm:w-44 sm:h-44 rounded-full overflow-hidden shrink-0">
                    <img src="{{ asset('images/home/foto miniatura michael barrios seccion 6.png') }}" alt="Michael Barrios" class="w-full h-full object-cover" />
                </div>
                <div>
                    <h3 class="font-sans text-3xl sm:text-2xl text-[#0a0a0a] font-black leading-none mb-2 normal-case tracking-normal">Michael Barrios</h3>
                    <p class="text-[#6b6b6b] text-lg sm:text-base mb-4">S.A. de C.V.</p>
                    <p class="text-[#2a2a2a] text-xs sm:text-sm leading-relaxed max-w-sm">Aportaciones y division del capital en acciones.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
const toggleBtn = document.getElementById('toggle-manifesto');
const manifestoEx = document.getElementById('manifesto-extra');
let manifestoOpen = false;
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        manifestoOpen = !manifestoOpen;
        manifestoEx.classList.toggle('hidden', !manifestoOpen);
        toggleBtn.textContent = manifestoOpen ? 'VER MENOS...' : 'VER MAS...';
    });
}
function switchCollection(slug) {
    document.querySelectorAll('.collection-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.dot-btn').forEach(d => {
        d.classList.remove('bg-[#0a0a0a]');
        d.classList.add('bg-[#c0c0c0]');
    });
    const panel = document.getElementById('panel-'+slug);
    if (panel) panel.classList.remove('hidden');
    const dot = document.querySelector('.dot-btn[data-dot="'+slug+'"]');
    if (dot) { dot.classList.remove('bg-[#c0c0c0]'); dot.classList.add('bg-[#0a0a0a]'); }
}
</script>
@endpush
