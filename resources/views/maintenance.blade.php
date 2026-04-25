<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento | Gutural</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#0a0a0a] min-h-screen">
    @if($maintenanceImage)
        <div class="fixed inset-0 w-full h-full">
            <img src="{{ asset('storage/' . $maintenanceImage) }}" 
                 alt="Sitio en mantenimiento" 
                 class="w-full h-full object-cover" />
        </div>
    @else
        <div class="fixed inset-0 w-full h-full flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="font-display text-4xl sm:text-6xl tracking-widest uppercase mb-4">Mantenimiento</h1>
                <p class="text-lg tracking-wider text-[#6b6b6b]">Volveremos pronto</p>
            </div>
        </div>
    @endif
</body>
</html>
