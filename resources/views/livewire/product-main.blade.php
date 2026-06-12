<div>
    <h1 class="text-3xl mb-10 border-b-3 pb-1 border-violet-500">Gestión de productos</h1>
    <div class="flex gap-2 mb-4">
        <flux:input placeholder="Buscar producto" icon="magnifying-glass"/>
        <flux:button variant="primary" color="violet" icon="plus">Nuevo</flux:button>
    </div>
    <flux:table>
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>NOMBRE</flux:table.column>
            <flux:table.column>CANTIDAD</flux:table.column>
            <flux:table.column>PRECIO</flux:table.column>
            <flux:table.column>DISPONIBLE</flux:table.column>
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
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
    <div>
        {{$productos->links()}}
    </div>
</div>
