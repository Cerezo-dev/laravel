<div>
    {{-- Galería de imágenes actuales --}}
    @if ($images->count())
        <div class="mb-5">
            {{-- Imagen principal --}}
            <div class="w-full h-52 rounded-lg overflow-hidden bg-zinc-100 shadow-sm mb-2">
                <img
                    id="main-preview-{{ $model->id }}"
                    src="{{ asset('storage/' . $images->first()->url) }}"
                    class="w-full h-full object-cover"
                >
            </div>
            {{-- Miniaturas --}}
            <div class="flex gap-2 flex-wrap">
                @foreach ($images as $image)
                    <div class="relative group">
                        <img
                            src="{{ asset('storage/' . $image->url) }}"
                            onclick="document.getElementById('main-preview-{{ $model->id }}').src = this.src"
                            class="w-16 h-16 object-cover rounded cursor-pointer border-2 border-transparent hover:border-violet-500 transition-colors"
                        >
                        <button
                            type="button"
                            wire:click="delete({{ $image->id }})"
                            wire:confirm="¿Eliminar esta imagen?"
                            class="absolute -top-1.5 -right-1.5 bg-red-500 hover:bg-red-600 text-white rounded-full p-0.5 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer shadow"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <hr class="border-zinc-200 mb-4">
    @else
        <div class="mb-4 flex flex-col items-center justify-center h-32 bg-zinc-50 rounded-lg border border-zinc-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="size-8 text-zinc-300 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 3h18M3 21h18" />
            </svg>
            <p class="text-sm text-zinc-400">Sin imágenes registradas</p>
        </div>
    @endif

    {{-- Formulario de subida --}}
    <form wire:submit="save">
        <label
            for="photo-input-{{ $model->id }}"
            class="flex flex-col items-center justify-center p-5 border-2 border-dashed border-zinc-300 rounded-lg text-center cursor-pointer hover:border-violet-400 hover:bg-violet-50 transition-colors"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="size-7 text-zinc-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            <p class="text-sm text-zinc-500">Arrastra tu imagen JPG o <span class="text-violet-600 font-medium">haz clic</span></p>
            <p class="text-xs text-zinc-400 mt-0.5">Máx. 2MB</p>
        </label>
        <input
            id="photo-input-{{ $model->id }}"
            type="file"
            wire:model="photo"
            accept="image/jpeg"
            class="hidden"
        >

        @error('photo')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        @if ($photo)
            <div class="mt-3 flex items-center gap-3 p-2 bg-zinc-50 rounded-lg border border-zinc-200">
                <img src="{{ $photo->temporaryUrl() }}" class="w-12 h-12 object-cover rounded shadow-sm">
                <span class="text-sm text-zinc-600 truncate">{{ $photo->getClientOriginalName() }}</span>
            </div>
        @endif

        <flux:button type="submit" variant="primary" color="violet" class="mt-3 w-full">Subir imagen</flux:button>
    </form>
</div>


