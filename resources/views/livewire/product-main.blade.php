<div>
    <h1 class="text-3xl mb-10 border-b-3 pb-1 border-violet-500">Gestión de productos</h1>
    <div class="flex gap-2 mb-4">
        <flux:input wire:model.live="search" placeholder="Buscar producto" icon="magnifying-glass"/>
        <flux:button wire:click="create()" variant="primary" color="violet" icon="plus" class="cursor-pointer">Nuevo</flux:button>
    </div>
    <flux:table>
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>NOMBRE</flux:table.column>
            <flux:table.column>CANTIDAD</flux:table.column>
            <flux:table.column>PRECIO</flux:table.column>
            <flux:table.column>DISPONIBLE</flux:table.column>
            <flux:table.column>OPCIONES</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($productos as $item)
                <flux:table.row>
                    <flux:table.cell class="flex items-center gap-3">
                        {{$item->id}}
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $item->nombre }}</flux:table.cell>
                    <flux:table.cell>{{ $item->cantidad }}</flux:table.cell>
                    <flux:table.cell variant="strong" class="text-right">S/. {{ number_format($item->precio,2) }}</flux:table.cell>
                    <flux:table.cell class="text-center">
                        <flux:badge size="sm" inset="top bottom" color="{{$item->disponible?'green':'red'}}">
                            {{ $item->disponible?"SI":"NO" }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        <flux:button wire:click="openUpload({{ $item}})" icon="photo" class="cursor-pointer"></flux:button>
                        <flux:button wire:click="edit({{ $item}})" variant="primary" color="amber" icon="pencil" class="cursor-pointer"></flux:button>
                        <flux:button wire:click="confirm({{ $item}})" variant="primary" color="red" icon="trash" class="cursor-pointer"></flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <div>
        {{$productos->links()}}
    </div>

    <flux:modal name="showform" flyout>
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Registrar Producto</flux:heading>
            </div>
            <flux:input wire:model="nombre" label="Nombre producto" placeholder="Piedra marfil" />
            <flux:textarea wire:model="descripcion" label="Descipción"/>
            <flux:input wire:model="cantidad" label="Cantidad" placeholder="12"/>
            <flux:input wire:model="precio" label="Precio" placeholder="45.50"/>
            <flux:checkbox wire:model="disponible" label="Disponible"/>
            <div class="flex gap-1">
                <flux:spacer />
                <flux:button x-on:click="$flux.modal('showform').close()">Cancelar</flux:button>
                <flux:button wire:click="save()" variant="primary" color="violet" icon="arrow-turn-down-right">Guardar</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-profile" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete project?</flux:heading>
                <flux:text class="mt-2">
                    You're about to delete this project.<br>
                    This action cannot be reversed.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button wire:click="delete()" variant="danger">Borrar registro</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="showUpload" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Imágenes del producto</flux:heading>
            </div>
            @if($productSelectedId)
                @livewire('image-uploader', ['model' => \App\Models\Product::find($productSelectedId)], key($productSelectedId))
            @endif
        </div>
    </flux:modal>
</div>
