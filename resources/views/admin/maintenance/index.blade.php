@extends('layouts.admin')

@section('title', 'Mantenimiento')
@section('page-title', 'Mantenimiento')

@section('content')
<div class="max-w-2xl">
    <form method="POST" action="{{ route('admin.maintenance.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- Maintenance Mode Toggle --}}
        <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
            <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Estado del Sitio</h2>
            
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold tracking-wider text-white mb-1">Modo Mantenimiento</p>
                    <p class="text-xs text-[#6b6b6b] tracking-wider">
                        Cuando está activo, los visitantes solo verán la imagen de mantenimiento
                    </p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="maintenance_mode" value="1" 
                           {{ $maintenanceMode ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-14 h-7 bg-[#2a2a2a] peer-focus:outline-none rounded-full peer 
                                peer-checked:after:translate-x-full peer-checked:after:border-white 
                                after:content-[''] after:absolute after:top-[2px] after:left-[2px] 
                                after:bg-white after:border-gray-300 after:border after:rounded-full 
                                after:h-6 after:w-6 after:transition-all peer-checked:bg-green-700"></div>
                </label>
            </div>

            @if($maintenanceMode)
            <div class="mt-4 px-4 py-3 bg-[#2a1a1a] border border-[#5a2a2a] text-[#e0a0a0] text-xs tracking-wider">
                ⚠️ El sitio está actualmente en modo mantenimiento
            </div>
            @endif
        </div>

        {{-- Maintenance Image --}}
        <div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
            <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Imagen de Mantenimiento</h2>

            @if($maintenanceImage)
            <div class="mb-6">
                <p class="text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-3">Imagen actual</p>
                <img src="{{ asset('storage/' . $maintenanceImage) }}" 
                     alt="Imagen de mantenimiento"
                     class="w-full max-w-md bg-[#1a1a1a] border border-[#2a2a2a]" />
            </div>
            @endif

            <div>
                <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                    {{ $maintenanceImage ? 'Cambiar imagen' : 'Subir imagen' }}
                </label>
                <div class="border-2 border-dashed border-[#2a2a2a] p-8 text-center cursor-pointer hover:border-[#6b6b6b] transition-colors">
                    <input type="file" id="maintenance-image" name="maintenance_image" accept="image/*" class="hidden" />
                    <label for="maintenance-image" class="cursor-pointer">
                        <svg class="h-10 w-10 mx-auto mb-3 text-[#6b6b6b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-xs text-[#6b6b6b] tracking-wider">Haz clic para seleccionar imagen</p>
                        <p class="text-[10px] text-[#6b6b6b] mt-1">JPG, PNG, WebP — máx. 5MB</p>
                    </label>
                </div>
                <div id="image-preview" class="mt-3"></div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.dashboard') }}" class="btn-outline text-xs">Cancelar</a>
            <button type="submit" class="btn-primary text-xs">Guardar cambios</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('maintenance-image').addEventListener('change', function() {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    
    if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="border border-[#2a2a2a] p-2 inline-block">
                    <img src="${e.target.result}" class="max-w-xs" />
                    <p class="text-xs text-[#6b6b6b] mt-2 text-center">Nueva imagen seleccionada</p>
                </div>
            `;
        };
        reader.readAsDataURL(this.files[0]);
    }
});
</script>
@endpush
@endsection
