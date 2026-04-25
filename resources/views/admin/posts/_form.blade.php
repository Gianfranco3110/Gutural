{{-- Shared post form partial --}}

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

{{-- ─── Info básica ─────────────────────────────────────────── --}}
<div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
    <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Información del Post</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- Título --}}
        <div class="md:col-span-2">
            <label for="title" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Título <span class="text-[#e0a0a0]">*</span>
            </label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $post->title ?? '') }}" required
                   class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                          focus:outline-none focus:border-[#c0c0c0] transition-colors"
                   placeholder="Ej: RESILENCE" />
        </div>

        {{-- Subtítulo --}}
        <div class="md:col-span-2">
            <label for="subtitle" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Subtítulo <span class="text-[#6b6b6b] font-normal normal-case">(opcional, ej: "(RESILENCIA)")</span>
            </label>
            <input type="text" id="subtitle" name="subtitle"
                   value="{{ old('subtitle', $post->subtitle ?? '') }}"
                   class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                          focus:outline-none focus:border-[#c0c0c0] transition-colors"
                   placeholder="(RESILENCIA)" />
        </div>

        {{-- Colección --}}
        <div>
            <label for="collection" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Colección <span class="text-[#e0a0a0]">*</span>
            </label>
            <select id="collection" name="collection" required
                    class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                           focus:outline-none focus:border-[#c0c0c0] transition-colors appearance-none">
                @foreach(['resilencia' => 'Resilencia', 'willpower' => 'Willpower', 'gratitude' => 'Gratitude', 'general' => 'General'] as $val => $label)
                <option value="{{ $val }}" {{ old('collection', $post->collection ?? '') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Publicado --}}
        <div class="flex items-center gap-3 pt-6">
            <input type="checkbox" id="is_published" name="is_published" value="1"
                   {{ old('is_published', $post->is_published ?? true) ? 'checked' : '' }}
                   class="accent-[#c0c0c0] w-4 h-4" />
            <label for="is_published" class="text-xs font-bold tracking-wider uppercase text-[#c0c0c0]">
                Publicado (visible en home)
            </label>
        </div>

        {{-- Extracto --}}
        <div class="md:col-span-2">
            <label for="excerpt" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Extracto <span class="text-[#6b6b6b] font-normal normal-case">(texto corto de la card del blog)</span>
            </label>
            <textarea id="excerpt" name="excerpt" rows="3"
                      class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                             focus:outline-none focus:border-[#c0c0c0] transition-colors resize-vertical"
                      placeholder="Descripción breve del post...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        </div>

        {{-- Contenido --}}
        <div class="md:col-span-2">
            <label for="content" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
                Contenido completo
            </label>
            <textarea id="content" name="content" rows="8"
                      class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                             focus:outline-none focus:border-[#c0c0c0] transition-colors resize-vertical"
                      placeholder="Contenido completo del post (para futura página de detalle)...">{{ old('content', $post->content ?? '') }}</textarea>
        </div>

    </div>
</div>

{{-- ─── Imagen ──────────────────────────────────────────────── --}}
<div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
    <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Imagen del Post (Card)</h2>

    @if(!empty($post->image))
    <div class="mb-4">
        <p class="text-[10px] uppercase tracking-widest text-[#6b6b6b] mb-2">Imagen actual</p>
        <img src="{{ asset('storage/' . $post->image) }}"
             alt="{{ $post->title }}"
             class="h-40 w-auto object-cover border border-[#2a2a2a]" />
    </div>
    @endif

    <label for="image" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
        {{ !empty($post->image) ? 'Reemplazar imagen' : 'Subir imagen' }}
        <span class="text-[#6b6b6b] font-normal normal-case">(JPG, PNG, WebP — máx. 5 MB)</span>
    </label>
    <input type="file" id="image" name="image" accept="image/*"
           class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                  focus:outline-none focus:border-[#c0c0c0] transition-colors
                  file:mr-4 file:bg-[#2a2a2a] file:border-0 file:text-[#f5f5f5]
                  file:text-xs file:font-bold file:tracking-wider file:uppercase
                  file:px-4 file:py-1.5 file:cursor-pointer" />

    <div id="img-preview" class="mt-4 hidden">
        <p class="text-[10px] uppercase tracking-widest text-[#6b6b6b] mb-2">Vista previa</p>
        <img id="img-preview-src" src="" alt="Preview" class="h-40 w-auto object-cover border border-[#2a2a2a]" />
    </div>
</div>

{{-- ─── Imagen Banner ───────────────────────────────────────── --}}
<div class="bg-[#0f0f0f] border border-[#2a2a2a] p-6 mb-4">
    <h2 class="text-xs font-bold tracking-widest uppercase text-[#6b6b6b] mb-6">Imagen Banner (Página de Detalle)</h2>

    @if(!empty($post->banner_image))
    <div class="mb-4">
        <p class="text-[10px] uppercase tracking-widest text-[#6b6b6b] mb-2">Banner actual</p>
        <img src="{{ asset($post->banner_image) }}"
             alt="{{ $post->title }}"
             class="h-40 w-auto object-cover border border-[#2a2a2a]" />
    </div>
    @endif

    <label for="banner_image" class="block text-[10px] font-bold tracking-widest uppercase text-[#6b6b6b] mb-2">
        {{ !empty($post->banner_image) ? 'Reemplazar banner' : 'Subir banner' }}
        <span class="text-[#6b6b6b] font-normal normal-case">(JPG, PNG, WebP — máx. 5 MB)</span>
    </label>
    <input type="file" id="banner_image" name="banner_image" accept="image/*"
           class="w-full bg-[#1a1a1a] border border-[#2a2a2a] text-[#f5f5f5] text-sm px-4 py-3
                  focus:outline-none focus:border-[#c0c0c0] transition-colors
                  file:mr-4 file:bg-[#2a2a2a] file:border-0 file:text-[#f5f5f5]
                  file:text-xs file:font-bold file:tracking-wider file:uppercase
                  file:px-4 file:py-1.5 file:cursor-pointer" />

    <div id="banner-preview" class="mt-4 hidden">
        <p class="text-[10px] uppercase tracking-widest text-[#6b6b6b] mb-2">Vista previa</p>
        <img id="banner-preview-src" src="" alt="Preview" class="h-40 w-auto object-cover border border-[#2a2a2a]" />
    </div>
</div>

@push('scripts')
<script>
document.getElementById('image').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        document.getElementById('img-preview-src').src = e.target.result;
        document.getElementById('img-preview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});

document.getElementById('banner_image').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        document.getElementById('banner-preview-src').src = e.target.result;
        document.getElementById('banner-preview').classList.remove('hidden');
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
