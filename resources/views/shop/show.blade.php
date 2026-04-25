@extends('layouts.app')

@section('title', $product->name . ' — Gutural')

@push('head')
<meta property="og:title" content="{{ $product->name }} — Gutural" />
<meta property="og:description" content="{{ Str::limit(strip_tags($product->description), 150) }}" />
<meta property="og:image" content="{{ $product->images->isNotEmpty() ? asset('storage/' . $product->images->first()->path) : '' }}" />
<meta property="og:url" content="{{ route('shop.show', $product->id) }}" />
<meta property="og:type" content="product" />
<meta property="product:price:amount" content="{{ $product->price }}" />
<meta property="product:price:currency" content="USD" />
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

{{-- Breadcrumb --}}
<section class="pt-20 sm:pt-24 pb-6 sm:pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <h1 class="font-display text-5xl sm:text-6xl lg:text-8xl text-[#0a0a0a] mb-3 sm:mb-4">SHOP</h1>
        <div class="flex flex-wrap gap-2 sm:gap-3 text-lg sm:text-xl lg:text-2xl">
            <a href="{{ route('shop.index', ['coleccion' => 'resilencia']) }}" class="font-display text-[#0a0a0a] hover:underline {{ $product->collection === 'resilencia' ? 'underline' : '' }}">RESILENCE</a>
            <a href="{{ route('shop.index', ['coleccion' => 'gratitude']) }}" class="font-display text-[#0a0a0a] hover:underline {{ $product->collection === 'gratitude' ? 'underline' : '' }}">GRATITUDE</a>
            <a href="{{ route('shop.index', ['coleccion' => 'willpower']) }}" class="font-display text-[#0a0a0a] hover:underline {{ $product->collection === 'willpower' ? 'underline' : '' }}">WILLPOWER</a>
        </div>
    </div>
</section>

{{-- Product Detail --}}
<section class="pb-12 sm:pb-16 lg:pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-10 lg:gap-12">
            
            {{-- Galería de imágenes --}}
            <div class="flex flex-col sm:flex-row gap-4">
                {{-- Miniaturas --}}
                <div class="flex sm:flex-col gap-3 order-2 sm:order-1">
                    <div class="flex sm:block overflow-x-auto sm:overflow-y-auto sm:max-h-[600px] gap-3 sm:w-24">
                        @foreach($product->images as $index => $image)
                        <button type="button" class="thumbnail-btn border-2 {{ $index === 0 ? 'border-[#0a0a0a]' : 'border-transparent' }} hover:border-[#0a0a0a] transition-colors flex-shrink-0" data-index="{{ $index }}" data-src="{{ asset('storage/' . $image->path) }}">
                            <img src="{{ $index < 3 ? asset('storage/' . $image->path) : '' }}" data-src="{{ asset('storage/' . $image->path) }}" alt="{{ $product->name }}" class="w-20 sm:w-full aspect-square object-cover {{ $index >= 3 ? 'lazy' : '' }}" loading="{{ $index < 3 ? 'eager' : 'lazy' }}" />
                        </button>
                        @endforeach
                    </div>
                    {{-- Botones de navegación --}}
                    <div class="hidden sm:flex gap-2">
                        <button type="button" id="prev-btn" class="flex-1 bg-[#0a0a0a] text-white p-2 hover:bg-[#2a2a2a] transition-colors">
                            <svg class="w-5 h-5 mx-auto rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button type="button" id="next-btn" class="flex-1 bg-[#0a0a0a] text-white p-2 hover:bg-[#2a2a2a] transition-colors">
                            <svg class="w-5 h-5 mx-auto -rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Imagen principal --}}
                <div class="flex-1 order-1 sm:order-2">
                    <div id="main-image" class="aspect-[3/4] overflow-hidden bg-[#e8e8e8]">
                        @if($product->images->isNotEmpty())
                        <img id="main-img" src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover" loading="eager" />
                        @endif
                    </div>
                </div>
            </div>

            {{-- Información del producto --}}
            <div>
                <h2 class="font-display text-3xl sm:text-4xl text-[#0a0a0a] mb-4 leading-none">{{ strtoupper($product->name) }}</h2>
                
                {{-- Descripción --}}
                @if($product->description)
                <div class="mb-4 text-[#0a0a0a] text-xs leading-relaxed text-justify">
                    {!! nl2br(e($product->description)) !!}
                </div>
                @endif

                {{-- Precio --}}
                <div class="mb-4 flex items-baseline gap-2">
                    @if($product->original_price && $product->original_price > $product->price)
                    <span class="text-[#6b6b6b] text-base line-through">REF: ${{ number_format($product->original_price, 0) }}</span>
                    @endif
                    <span class="text-[#6b6b6b] text-2xl">REF:</span>
                    <span class="text-[#0a0a0a] text-2xl font-bold">${{ number_format($product->price, 0) }}</span>
                </div>

                {{-- Género y Color --}}
                <div class="flex flex-wrap gap-4 sm:gap-6 mb-4">
                    <div>
                        <p class="text-[#0a0a0a] text-xs font-bold mb-2">GENERO</p>
                        <div class="flex gap-2">
                            <button type="button" class="gender-btn border-2 border-[#0a0a0a] px-3 py-1.5 text-xs font-bold hover:bg-[#0a0a0a] hover:text-white transition-colors cursor-pointer" data-gender="M">M</button>
                            <button type="button" class="gender-btn border-2 border-[#0a0a0a] px-3 py-1.5 text-xs font-bold hover:bg-[#0a0a0a] hover:text-white transition-colors cursor-pointer" data-gender="F">F</button>
                        </div>
                    </div>

                    @if($product->variants->isNotEmpty())
                    <div>
                        <p class="text-[#0a0a0a] text-xs font-bold mb-2">COLOR</p>
                        <div class="flex gap-2">
                            @foreach($product->variants->unique('color') as $variant)
                            <button type="button" class="color-btn w-[42px] h-[30px] border-2 border-transparent hover:scale-110 transition-transform cursor-pointer" style="background-color: {{ $variant->hex_color ?? '#000' }}" data-color="{{ $variant->color }}"></button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Cantidad y Talla --}}
                @if($product->variants->isNotEmpty())
                <div class="flex flex-wrap gap-4 sm:gap-6 mb-4">
                    <div>
                        <p class="text-[#0a0a0a] text-xs font-bold mb-2">CANTIDAD</p>
                        <div class="flex items-center border-2 border-[#0a0a0a]">
                            <button type="button" id="decrease-qty" class="px-3 py-1.5 text-xs font-bold hover:bg-[#0a0a0a] hover:text-white transition-colors cursor-pointer">-</button>
                            <input type="number" id="quantity" value="1" min="1" class="w-12 text-center border-x-2 border-[#0a0a0a] py-1.5 text-xs focus:outline-none" />
                            <button type="button" id="increase-qty" class="px-3 py-1.5 text-xs font-bold hover:bg-[#0a0a0a] hover:text-white transition-colors cursor-pointer">+</button>
                        </div>
                    </div>

                    <div>
                        <p class="text-[#0a0a0a] text-xs font-bold mb-2">TALLA</p>
                        <div class="flex gap-2 flex-wrap">
                            @foreach(collect($product->variants->pluck('sizes')->flatten()->unique()->sort()->values()) as $size)
                            <button type="button" class="size-btn border-2 border-[#0a0a0a] px-3 py-1.5 text-xs font-bold hover:bg-[#0a0a0a] hover:text-white transition-colors cursor-pointer" data-size="{{ $size }}">{{ $size }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Botón agregar al carrito --}}
                <button type="button" id="add-to-cart-btn" class="w-full sm:w-auto bg-transparent border-2 border-[#0a0a0a] text-[#0a0a0a] rounded-md px-6 py-2.5 text-xs font-bold tracking-wider uppercase hover:bg-[#0a0a0a] hover:text-white transition-colors flex items-center justify-center gap-2">
                    AGREGAR AL CARRITO
                    <svg class="w-5 h-5 text-[#6b6b6b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </button>
                <p id="error-message" class="text-red-600 text-xs mt-2 hidden"></p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Lazy loading de imágenes
const lazyImages = document.querySelectorAll('img.lazy');
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    lazyImages.forEach(img => imageObserver.observe(img));
} else {
    lazyImages.forEach(img => img.src = img.dataset.src);
}

// Galería de imágenes - Optimizado
const thumbnails = document.querySelectorAll('.thumbnail-btn');
const mainImg = document.getElementById('main-img');
let currentIndex = 0;
const imageCache = new Map();

// Pre-cargar imágenes en cache
thumbnails.forEach((btn, index) => {
    const src = btn.dataset.src;
    if (index < 4) {
        const img = new Image();
        img.src = src;
        imageCache.set(index, src);
    }
});

const updateMainImage = () => {
    const src = thumbnails[currentIndex].dataset.src;
    if (!imageCache.has(currentIndex)) {
        const img = new Image();
        img.src = src;
        imageCache.set(currentIndex, src);
    }
    mainImg.src = src;
};

const updateThumbnailBorders = () => {
    thumbnails.forEach((btn, index) => {
        btn.classList.toggle('border-[#0a0a0a]', index === currentIndex);
        btn.classList.toggle('border-transparent', index !== currentIndex);
    });
};

thumbnails.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        currentIndex = index;
        updateMainImage();
        updateThumbnailBorders();
    }, { passive: true });
});

document.getElementById('prev-btn').addEventListener('click', () => {
    currentIndex = currentIndex > 0 ? currentIndex - 1 : thumbnails.length - 1;
    updateMainImage();
    updateThumbnailBorders();
}, { passive: true });

document.getElementById('next-btn').addEventListener('click', () => {
    currentIndex = currentIndex < thumbnails.length - 1 ? currentIndex + 1 : 0;
    updateMainImage();
    updateThumbnailBorders();
}, { passive: true });

// Cantidad - Optimizado
const qtyInput = document.getElementById('quantity');
document.getElementById('decrease-qty').addEventListener('click', () => {
    const val = parseInt(qtyInput.value);
    if (val > 1) qtyInput.value = val - 1;
}, { passive: true });

document.getElementById('increase-qty').addEventListener('click', () => {
    qtyInput.value = parseInt(qtyInput.value) + 1;
}, { passive: true });

// Selección de opciones - Optimizado
let selectedGender = null;
let selectedColor = null;
let selectedSize = null;

const genderBtns = document.querySelectorAll('.gender-btn');
const colorBtns = document.querySelectorAll('.color-btn');
const sizeBtns = document.querySelectorAll('.size-btn');

genderBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        if (selectedGender) selectedGender.classList.remove('bg-[#0a0a0a]', 'text-white');
        this.classList.add('bg-[#0a0a0a]', 'text-white');
        selectedGender = this;
    });
});

colorBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        if (selectedColor) selectedColor.classList.remove('border-[#0a0a0a]');
        this.classList.add('border-[#0a0a0a]');
        selectedColor = this;
    });
});

sizeBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        if (selectedSize) selectedSize.classList.remove('bg-[#0a0a0a]', 'text-white');
        this.classList.add('bg-[#0a0a0a]', 'text-white');
        selectedSize = this;
    });
});

// Agregar al carrito - WhatsApp
const addToCartBtn = document.getElementById('add-to-cart-btn');
const errorMessage = document.getElementById('error-message');
const whatsappNumber = '{{ config("whatsapp.number") }}';

addToCartBtn.addEventListener('click', function() {
    errorMessage.classList.add('hidden');
    
    if (!whatsappNumber) {
        errorMessage.textContent = 'Error: Número de WhatsApp no configurado';
        errorMessage.classList.remove('hidden');
        return;
    }
    
    if (!selectedColor) {
        errorMessage.textContent = 'Por favor selecciona un color';
        errorMessage.classList.remove('hidden');
        return;
    }
    
    if (!selectedSize) {
        errorMessage.textContent = 'Por favor selecciona una talla';
        errorMessage.classList.remove('hidden');
        return;
    }
    
    const productName = '{{ $product->name }}';
    const color = selectedColor.dataset.color;
    const size = selectedSize.dataset.size;
    const quantity = parseInt(qtyInput.value) || 1;
    const productUrl = '{{ route('shop.show', $product->id) }}';
    
    const message = `Hola, estoy interesado en el producto:\n*${productName}*\nColor: ${color}\nTalla: ${size}\nCantidad: ${quantity}\n\n${productUrl}`;
    
    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
});
</script>
@endpush
