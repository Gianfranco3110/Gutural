{{-- Shared product form partial — used by create.blade.php and edit.blade.php --}}

@php
    $isEdit = $product !== null;
    $sizesOptions = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
@endphp

{{-- Validation errors --}}
@if($errors->any())
<div class="mb-6 px-4 py-3 bg-[#2a1a1a] border border-[#5a2a2a] text-[#e0a0a0] text-xs tracking-wider">
    <p class="font-bold mb-1">Por favor corrige los errores:</p>
    <ul class="list-disc list-inside space-y-0.5">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- ─── Basic Info ─────────────────────────────────────────── --}}
<div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
    <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Información del Producto</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        {{-- Name --}}
        <div class="md:col-span-2">
            <label for="name" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Nombre <span class="text-[#e0a0a0]">*</span>
            </label>
            <input type="text" id="name" name="name"
                   value="{{ old('name', $product->name ?? '') }}" required
                   class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                          focus:outline-none focus:border-[#c0c0c0] transition-colors"
                   placeholder="Ej: Camiseta Resilencia" />
        </div>

        {{-- Price --}}
        <div>
            <label for="price" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Precio (USD) <span class="text-[#e0a0a0]">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#6b6b6b] text-sm">$</span>
                <input type="number" id="price" name="price" step="0.01" min="0"
                       value="{{ old('price', $product->price ?? '') }}" required
                       class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm pl-8 pr-4 py-3
                              focus:outline-none focus:border-[#c0c0c0] transition-colors"
                       placeholder="0.00" />
            </div>
        </div>

        {{-- Type --}}
        <div>
            <label for="type" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Tipo <span class="text-[#e0a0a0]">*</span>
            </label>
            <select id="type" name="type" required
                    class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                           focus:outline-none focus:border-[#c0c0c0] transition-colors appearance-none">
                <option value="">Seleccionar...</option>
                <option value="tshirt"    {{ old('type', $product->type ?? '') === 'tshirt'    ? 'selected' : '' }}>T-Shirt / Camiseta</option>
                <option value="mono"      {{ old('type', $product->type ?? '') === 'mono'      ? 'selected' : '' }}>Mono / Jumpsuit</option>
                <option value="accesorio" {{ old('type', $product->type ?? '') === 'accesorio' ? 'selected' : '' }}>Accesorio</option>
            </select>
        </div>

        {{-- Collection --}}
        <div>
            <label for="collection" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Colección <span class="text-[#e0a0a0]">*</span>
            </label>
            <select id="collection" name="collection" required
                    class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                           focus:outline-none focus:border-[#c0c0c0] transition-colors appearance-none">
                <option value="">Seleccionar...</option>
                <option value="resilencia" {{ old('collection', $product->collection ?? '') === 'resilencia' ? 'selected' : '' }}>Resilencia</option>
                <option value="willpower"  {{ old('collection', $product->collection ?? '') === 'willpower'  ? 'selected' : '' }}>Willpower</option>
                <option value="gratitude"  {{ old('collection', $product->collection ?? '') === 'gratitude'  ? 'selected' : '' }}>Gratitude</option>
                <option value="general"    {{ old('collection', $product->collection ?? '') === 'general'    ? 'selected' : '' }}>General</option>
            </select>
        </div>

        {{-- Active toggle --}}
        <div class="flex items-center gap-3 pt-6">
            <input type="checkbox" id="is_active" name="is_active" value="1"
                   {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                   class="accent-[#c0c0c0] w-4 h-4" />
            <label for="is_active" class="text-xs font-bold tracking-wider uppercase text-[#c0c0c0]">
                Producto activo (visible en tienda)
            </label>
        </div>

        {{-- Description --}}
        <div class="md:col-span-2">
            <label for="description" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Descripción
            </label>
            <textarea id="description" name="description" rows="4"
                      class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                             focus:outline-none focus:border-[#c0c0c0] transition-colors resize-vertical"
                      placeholder="Describe el producto...">{{ old('description', $product->description ?? '') }}</textarea>
        </div>
    </div>
</div>

{{-- ─── Variants ───────────────────────────────────────────── --}}
<div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b]">Variantes (Color + Tallas)</h2>
        <button type="button" id="add-variant"
                class="text-xs font-bold tracking-wider uppercase text-[#c0c0c0] border border-[#2a2a2a]
                       px-3 py-1.5 hover:bg-[#1a1a1a] transition-colors">
            + Añadir variante
        </button>
    </div>

    <div id="variants-container" class="space-y-4">
        @if($isEdit && $product->variants->isNotEmpty())
            @foreach($product->variants as $vi => $variant)
            <div class="variant-row border border-[#2a2a2a] p-4 relative">
                <button type="button" class="remove-variant absolute top-3 right-3 text-[#6b6b6b] hover:text-[#e0a0a0] transition-colors text-lg leading-none">&times;</button>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Color</label>
                        <input type="text" name="variants[{{ $vi }}][color]" value="{{ $variant->color }}"
                               class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-3 py-2
                                      focus:outline-none focus:border-[#c0c0c0] transition-colors"
                               placeholder="Negro" />
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Hex Color</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="variants[{{ $vi }}][hex_color]" value="{{ $variant->hex_color ?? '#000000' }}"
                                   class="w-10 h-10 bg-transparent border border-[#2a2a2a] cursor-pointer p-0.5" />
                            <input type="text" value="{{ $variant->hex_color ?? '#000000' }}" readonly
                                   class="flex-1 bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-3 py-2 hex-preview" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Tallas</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($sizesOptions as $size)
                            <label class="flex items-center gap-1 cursor-pointer">
                                <input type="checkbox" name="variants[{{ $vi }}][sizes][]" value="{{ $size }}"
                                       {{ in_array($size, $variant->sizes ?? []) ? 'checked' : '' }}
                                       class="accent-[#c0c0c0]" />
                                <span class="text-xs tracking-wider text-[#c0c0c0]">{{ $size }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            {{-- Default empty variant --}}
            <div class="variant-row border border-[#2a2a2a] p-4 relative">
                <button type="button" class="remove-variant absolute top-3 right-3 text-[#6b6b6b] hover:text-[#e0a0a0] transition-colors text-lg leading-none">&times;</button>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Color</label>
                        <input type="text" name="variants[0][color]" value="{{ old('variants.0.color', '') }}"
                               class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-3 py-2
                                      focus:outline-none focus:border-[#c0c0c0] transition-colors"
                               placeholder="Negro" />
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Hex Color</label>
                        <div class="flex items-center gap-2">
                            <input type="color" name="variants[0][hex_color]" value="#000000"
                                   class="w-10 h-10 bg-transparent border border-[#2a2a2a] cursor-pointer p-0.5" />
                            <input type="text" value="#000000" readonly
                                   class="flex-1 bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-3 py-2 hex-preview" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Tallas</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($sizesOptions as $size)
                            <label class="flex items-center gap-1 cursor-pointer">
                                <input type="checkbox" name="variants[0][sizes][]" value="{{ $size }}" class="accent-[#c0c0c0]" />
                                <span class="text-xs tracking-wider text-[#c0c0c0]">{{ $size }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- ─── Images ─────────────────────────────────────────────── --}}
<div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
    <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Imágenes del Producto</h2>

    @if($isEdit && $product->images->isNotEmpty())
    <div class="mb-6">
        <p class="text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-3">Imágenes actuales</p>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
            @foreach($product->images as $image)
            <div class="relative group">
                <img src="{{ asset('storage/' . $image->path) }}" alt="Imagen producto"
                     class="w-full aspect-square object-cover bg-[#1a1a1a]" />
                <label class="absolute inset-0 bg-black/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                    <div class="text-center">
                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                               class="accent-[#e0a0a0] w-4 h-4" />
                        <p class="text-[10px] text-white mt-1 tracking-wider">Eliminar</p>
                    </div>
                </label>
                @if($image->is_primary)
                <span class="absolute top-1 left-1 bg-[#0a0a0a]/80 text-[#a0e0a0] text-[9px] tracking-widest uppercase px-1 py-0.5">Principal</span>
                @endif
            </div>
            @endforeach
        </div>
        <p class="text-[10px] text-[#6b6b6b] mt-2">Hover sobre una imagen y marca el checkbox para eliminarla al guardar.</p>
    </div>
    @endif

    {{-- Upload new --}}
    <div>
        <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
            {{ $isEdit ? 'Agregar nuevas imágenes' : 'Imágenes' }}
        </label>
        <div id="drop-zone"
             class="border-2 border-dashed border-[#2a2a2a] p-8 text-center cursor-pointer hover:border-[#6b6b6b] transition-colors">
            <input type="file" id="images-input" name="images[]" multiple accept="image/*" class="hidden" />
            <label for="images-input" class="cursor-pointer">
                <svg class="h-10 w-10 mx-auto mb-3 text-[#6b6b6b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-xs text-[#6b6b6b] tracking-wider">Haz clic o arrastra imágenes aquí</p>
                <p class="text-[10px] text-[#6b6b6b] mt-1">JPG, PNG, WebP — máx. 5MB por imagen</p>
            </label>
        </div>
        <div id="image-previews" class="grid grid-cols-3 sm:grid-cols-6 gap-2 mt-3"></div>
    </div>
</div>

@push('scripts')
<script>
// ─── Variant rows ───────────────────────────────────────────
let variantIndex = document.querySelectorAll('.variant-row').length;

function syncHex(row) {
    const colorInput = row.querySelector('input[type="color"]');
    const preview    = row.querySelector('.hex-preview');
    if (colorInput && preview) {
        colorInput.addEventListener('input', () => { preview.value = colorInput.value; });
    }
}

document.querySelectorAll('.variant-row').forEach(syncHex);

document.querySelectorAll('.remove-variant').forEach(btn => {
    btn.addEventListener('click', () => btn.closest('.variant-row').remove());
});

document.getElementById('add-variant').addEventListener('click', () => {
    const sizes = @json($sizesOptions);
    const idx   = variantIndex++;
    const html  = `
        <div class="variant-row border border-[#2a2a2a] p-4 relative">
            <button type="button" class="remove-variant absolute top-3 right-3 text-[#6b6b6b] hover:text-[#e0a0a0] transition-colors text-lg leading-none">&times;</button>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Color</label>
                    <input type="text" name="variants[${idx}][color]"
                           class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-3 py-2 focus:outline-none focus:border-[#c0c0c0] transition-colors"
                           placeholder="Negro" />
                </div>
                <div>
                    <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Hex Color</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="variants[${idx}][hex_color]" value="#000000"
                               class="w-10 h-10 bg-transparent border border-[#2a2a2a] cursor-pointer p-0.5" />
                        <input type="text" value="#000000" readonly
                               class="flex-1 bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-3 py-2 hex-preview" />
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">Tallas</label>
                    <div class="flex flex-wrap gap-2">
                        ${sizes.map(s => `
                        <label class="flex items-center gap-1 cursor-pointer">
                            <input type="checkbox" name="variants[${idx}][sizes][]" value="${s}" class="accent-[#c0c0c0]" />
                            <span class="text-xs tracking-wider text-[#c0c0c0]">${s}</span>
                        </label>`).join('')}
                    </div>
                </div>
            </div>
        </div>`;
    const container = document.getElementById('variants-container');
    container.insertAdjacentHTML('beforeend', html);
    const newRow = container.lastElementChild;
    syncHex(newRow);
    newRow.querySelector('.remove-variant').addEventListener('click', () => newRow.remove());
});

// ─── Image preview ──────────────────────────────────────────
document.getElementById('images-input').addEventListener('change', function () {
    const previews = document.getElementById('image-previews');
    previews.innerHTML = '';
    Array.from(this.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            previews.insertAdjacentHTML('beforeend',
                `<div class="aspect-square bg-[#1a1a1a] overflow-hidden">
                    <img src="${e.target.result}" class="w-full h-full object-cover" />
                 </div>`);
        };
        reader.readAsDataURL(file);
    });
});

// ─── Drag & drop zone ───────────────────────────────────────
const dz = document.getElementById('drop-zone');
['dragenter','dragover'].forEach(ev => dz.addEventListener(ev, e => {
    e.preventDefault(); dz.classList.add('border-[#c0c0c0]');
}));
['dragleave','drop'].forEach(ev => dz.addEventListener(ev, e => {
    e.preventDefault(); dz.classList.remove('border-[#c0c0c0]');
}));
dz.addEventListener('drop', e => {
    const input = document.getElementById('images-input');
    input.files = e.dataTransfer.files;
    input.dispatchEvent(new Event('change'));
});
</script>
@endpush
