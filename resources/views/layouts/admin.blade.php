<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Panel') | Gutural Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0a] text-[#f5f5f5] min-h-screen flex">

    {{-- ─── Sidebar ───────────────────────────────────────────── --}}
    <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0f0f0f] border-r border-[#2a2a2a] flex flex-col
                  transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out"
           id="sidebar">
        {{-- Logo --}}
        <div class="flex items-center justify-between h-16 px-6 border-b border-[#2a2a2a]">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/logo-footer.png') }}" alt="Gutural" class="h-7 w-auto" />
            </a>
            <button type="button" id="close-sidebar" class="lg:hidden text-[#6b6b6b] hover:text-white">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 overflow-y-auto">
            <p class="text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-3 px-2">Panel</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors
                              {{ request()->routeIs('admin.dashboard') ? 'bg-[#2a2a2a] text-white' : 'text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                </li>
            </ul>

            <p class="text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mt-6 mb-3 px-2">Catálogo</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.products.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors
                              {{ request()->routeIs('admin.products.*') ? 'bg-[#2a2a2a] text-white' : 'text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10" />
                        </svg>
                        Productos
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.create') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nuevo Producto
                    </a>
                </li>
            </ul>

            <p class="text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mt-6 mb-3 px-2">Blog</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.posts.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors
                              {{ request()->routeIs('admin.posts.*') ? 'bg-[#2a2a2a] text-white' : 'text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        Posts
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.posts.create') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nuevo Post
                    </a>
                </li>
            </ul>

            <p class="text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mt-6 mb-3 px-2">Sitio</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.maintenance.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors
                              {{ request()->routeIs('admin.maintenance.*') ? 'bg-[#2a2a2a] text-white' : 'text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white' }}">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Mantenimiento
                    </a>
                </li>
                <li>
                    <a href="{{ route('shop.index') }}" target="_blank"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase transition-colors text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Ver tienda
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="px-4 py-4 border-t border-[#2a2a2a]">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded text-xs font-bold tracking-wider uppercase text-[#6b6b6b] hover:bg-[#1a1a1a] hover:text-white transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- ─── Main area ─────────────────────────────────────────── --}}
    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
        {{-- Top bar --}}
        <header class="h-16 bg-[#0f0f0f] border-b border-[#2a2a2a] flex items-center justify-between px-6 sticky top-0 z-40">
            <button type="button" id="open-sidebar" class="lg:hidden text-[#6b6b6b] hover:text-white">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="lg:flex-1">
                <h1 class="font-display text-2xl sm:text-3xl tracking-widest uppercase text-white">@yield('page-title', 'Panel de administración')</h1>
            </div>
            <span class="text-xs text-[#6b6b6b] hidden sm:block">{{ auth()->user()->name }}</span>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="mx-6 mt-4 px-4 py-3 bg-[#1a2a1a] border border-[#2a5a2a] text-[#a0e0a0] text-xs tracking-wider rounded flex items-center justify-between">
            <span>{{ session('success') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-[#a0e0a0] hover:text-white ml-4">✕</button>
        </div>
        @endif
        @if(session('error'))
        <div class="mx-6 mt-4 px-4 py-3 bg-[#2a1a1a] border border-[#5a2a2a] text-[#e0a0a0] text-xs tracking-wider rounded flex items-center justify-between">
            <span>{{ session('error') }}</span>
            <button type="button" onclick="this.parentElement.remove()" class="text-[#e0a0a0] hover:text-white ml-4">✕</button>
        </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    {{-- Mobile sidebar overlay --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/60 z-40 hidden lg:hidden"></div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        document.getElementById('open-sidebar').addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });
        document.getElementById('close-sidebar').addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
