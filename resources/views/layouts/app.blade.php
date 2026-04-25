<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Gutural') | Gutural</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen flex flex-col text-[#1a1a1a]">

    {{-- ─── Navigation ───────────────────────────────────────── --}}
    <nav class="z-50 px-6 sm:px-10 lg:px-16 pt-6">
        <div class="bg-[#2a2a2a]/95 backdrop-blur-md shadow-2xl rounded-full px-6 py-2">
            <div class="flex items-center justify-between gap-6">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                    <img src="{{ asset('images/logoHeader.png') }}" alt="Gutural" class="h-4 sm:h-5 w-auto" />
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center gap-8 flex-1">
                    <a href="{{ route('home') }}"
                       class="text-[15px] font-normal tracking-wide transition-colors
                              {{ request()->routeIs('home') ? 'text-white' : 'text-[#ccc] hover:text-white' }}">
                        Inicio
                    </a>
                    <a href="{{ route('home') }}#concepto"
                       class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white transition-colors">
                        Concepto
                    </a>
                    <a href="{{ route('shop.index') }}"
                       class="text-[15px] font-normal tracking-wide transition-colors
                              {{ request()->routeIs('shop.*') ? 'text-white' : 'text-[#ccc] hover:text-white' }}">
                        Tienda
                    </a>
                    <a href="{{ route('blog.index') }}"
                       class="text-[15px] font-normal tracking-wide transition-colors
                              {{ request()->routeIs('blog.*') ? 'text-white' : 'text-[#ccc] hover:text-white' }}">
                        Blog
                    </a>
                    <a href="{{ route('home') }}#quienes-somos"
                       class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white transition-colors">
                        ¿Quienes somos?
                    </a>
                </div>

                {{-- Right: Search + Mobile --}}
                <div class="flex items-center gap-4 flex-shrink-0">
                    <div class="hidden sm:block relative">
                        <div class="flex items-center gap-3">
                            <label for="search-input" class="text-white text-[11px] font-normal tracking-wide whitespace-nowrap">busqueda</label>
                            <div class="flex items-center gap-2 bg-transparent border-b border-[#555] px-3 py-1">
                                <input type="search" id="search-input" placeholder="" autocomplete="off"
                                       class="bg-transparent text-[11px] text-white/80 placeholder-[#888]
                                              focus:outline-none w-32 lg:w-48" />
                                <button type="button" class="flex-shrink-0">
                                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div id="search-results" class="hidden absolute top-full right-0 mt-2 w-80 bg-white rounded-lg shadow-2xl max-h-96 overflow-y-auto z-50"></div>
                    </div>
                    <button type="button" id="mobile-menu-btn" class="lg:hidden text-[#ccc] hover:text-white" aria-label="Menú">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden lg:hidden mt-2">
            <div class="bg-[#2a2a2a]/95 backdrop-blur-md rounded-3xl px-6 py-5 flex flex-col gap-4">
                <a href="{{ route('home') }}"       class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white">Inicio</a>
                <a href="{{ route('home') }}#concepto" class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white">Concepto</a>
                <a href="{{ route('shop.index') }}" class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white">Tienda</a>
                <a href="{{ route('blog.index') }}" class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white">Blog</a>
                <a href="{{ route('home') }}#quienes-somos" class="text-[15px] font-normal tracking-wide text-[#ccc] hover:text-white">¿Quienes somos?</a>
                <div class="relative">
                    <div class="flex items-center gap-2 bg-transparent border-b border-[#555] px-3 py-2 mt-2">
                        <label for="search-input-mobile" class="text-white text-[11px] font-normal tracking-wide">busqueda</label>
                        <input type="search" id="search-input-mobile" placeholder="" autocomplete="off"
                               class="bg-transparent text-[11px] text-white/80 placeholder-[#888]
                                      focus:outline-none w-full" />
                        <svg class="h-4 w-4 text-[#888]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
                        </svg>
                    </div>
                    <div id="search-results-mobile" class="hidden absolute top-full left-0 right-0 mt-2 bg-white rounded-lg shadow-2xl max-h-96 overflow-y-auto z-50"></div>
                </div>
            </div>
        </div>
    </nav>

    {{-- ─── Main Content ──────────────────────────────────────── --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ─── Footer ────────────────────────────────────────────── --}}
    <footer class="bg-[#58595c] border-t border-[#4d4e50] py-8 sm:py-9">
        <div class="max-w-6xl mx-auto px-6 sm:px-10">
            <div class="flex items-center justify-between gap-6">
                <p class="text-[10px] sm:text-xs uppercase tracking-widest text-[#9a9a9a]">ALL RIGHTS RESERVED BY <span class="font-bold text-[#b0b0b0]">GUTURAL</span></p>
                <div class="flex items-center gap-3 sm:gap-4 text-[#8f8f8f]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                    <img src="{{ asset('images/logo-footer.png') }}" alt="Gutural" class="h-7 sm:h-8 w-auto opacity-70" />
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function () {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        // Search functionality
        let searchTimeout;
        const searchInput = document.getElementById('search-input');
        const searchInputMobile = document.getElementById('search-input-mobile');
        const searchResults = document.getElementById('search-results');
        const searchResultsMobile = document.getElementById('search-results-mobile');

        function performSearch(query, resultsContainer) {
            if (query.length < 2) {
                resultsContainer.classList.add('hidden');
                return;
            }

            fetch(`/api/search-products?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        resultsContainer.innerHTML = '<div class="p-4 text-center text-gray-500 text-sm">No se encontraron productos</div>';
                        resultsContainer.classList.remove('hidden');
                        return;
                    }

                    let html = '<div class="py-2">';
                    data.forEach(product => {
                        const image = product.images && product.images.length > 0 ? `/storage/${product.images[0].path}` : '/images/placeholder.png';
                        const price = product.price ? `$${parseFloat(product.price).toFixed(2)}` : 'Precio no disponible';
                        html += `
                            <a href="/tienda/${product.slug}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors">
                                <img src="${image}" alt="${product.name}" class="w-16 h-16 object-cover rounded" onerror="this.src='/images/placeholder.png'" />
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-gray-900 uppercase">${product.name}</h4>
                                    <p class="text-xs text-gray-600 mt-1">${price}</p>
                                </div>
                            </a>
                        `;
                    });
                    html += '</div>';
                    
                    resultsContainer.innerHTML = html;
                    resultsContainer.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsContainer.classList.add('hidden');
                });
        }

        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    performSearch(e.target.value, searchResults);
                }, 300);
            });

            searchInput.addEventListener('blur', function() {
                setTimeout(() => searchResults.classList.add('hidden'), 200);
            });

            searchInput.addEventListener('focus', function(e) {
                if (e.target.value.length >= 2) {
                    performSearch(e.target.value, searchResults);
                }
            });
        }

        if (searchInputMobile) {
            searchInputMobile.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    performSearch(e.target.value, searchResultsMobile);
                }, 300);
            });

            searchInputMobile.addEventListener('blur', function() {
                setTimeout(() => searchResultsMobile.classList.add('hidden'), 200);
            });

            searchInputMobile.addEventListener('focus', function(e) {
                if (e.target.value.length >= 2) {
                    performSearch(e.target.value, searchResultsMobile);
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
