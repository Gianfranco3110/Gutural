<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login | Gutural</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0a] text-[#f5f5f5] min-h-screen flex items-center justify-center px-4"
      style="background-image: url('{{ asset('images/home/mujer pixelada home.png') }}'); background-size: contain; background-position: left center; background-repeat: no-repeat;">

    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#0a0a0a]/70 to-[#0a0a0a]/95"></div>

    <div class="relative z-10 w-full max-w-sm">
        {{-- Logo --}}
        <div class="flex justify-center mb-10">
            <img src="{{ asset('images/logo-footer.png') }}" alt="Gutural" class="h-12 w-auto" />
        </div>

        {{-- Card --}}
        <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-8 relative">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h1 class="font-display text-xl tracking-widest mb-1 text-white">Acceso Admin</h1>
                    <p class="text-xs text-white tracking-wider">Área exclusiva para administradores</p>
                </div>
                <img src="{{ asset('images/shop/guts-shop.png') }}" alt="Guts" class="h-16 w-auto opacity-80" />
            </div>

            {{-- Errors --}}
            @if($errors->any())
            <div class="mb-6 px-4 py-3 bg-[#2a1a1a] border border-[#5a2a2a] text-[#e0a0a0] text-xs tracking-wider">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[10px] font-bold tracking-widest uppercase text-white mb-2">
                        Correo electrónico
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           autocomplete="email"
                           class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                                  focus:outline-none focus:border-[#c0c0c0] transition-colors placeholder-[#6b6b6b]"
                           placeholder="admin@gutural.com" />
                </div>

                <div>
                    <label for="password" class="block text-[10px] font-bold tracking-widest uppercase text-white mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="current-password"
                               class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3 pr-12
                                      focus:outline-none focus:border-[#c0c0c0] transition-colors" />
                        <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#6b6b6b] hover:text-[#c0c0c0] transition-colors">
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" id="remember" name="remember" value="1"
                           class="accent-[#c0c0c0]" />
                    <label for="remember" class="text-xs text-white tracking-wider">Recordarme</label>
                </div>

                <button type="submit" class="btn-primary w-full py-3 text-center block">
                    Entrar al panel
                </button>
            </form>
        </div>

        <p class="text-center text-[10px] text-white tracking-wider mt-6">
            <a href="{{ route('home') }}" class="hover:text-[#c0c0c0] transition-colors">← Volver al sitio</a>
        </p>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
        });
    </script>
</body>
</html>

