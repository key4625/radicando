<td class="px-3 py-2 md:px-6 md:py-4 whitespace-nowrap text-sm leading-5 text-gray-900">
    <img class="img-responsive" src="{{ $row->getImage() }}" style="height:45px;">
</td> 

<x-livewire-tables::table.cell>
    {{ $row->nome }}
</x-livewire-tables::table.cell>
@if($confirming===$row->id)
    <td class="px-3 py-2 md:px-6 md:py-4 whitespace-nowrap text-sm leading-5 text-gray-900 text-right" colspan="100%">
        Vuoi cancellare?
        <div class="btn-group ml-2" role="group" aria-label="Basic example">
            <button wire:click="delete({{ $row->id }})" class="btn btn-danger hover:bg-red-600">Si</button>
            <button wire:click="confirmDelete(0)"  class="btn btn-secondary hover:bg-red-600">No</button>
        </div>
    </td>
@else 
    <x-livewire-tables::table.cell>
        {{$row->nome_cat}} 
    </x-livewire-tables::table.cell>

    <x-livewire-tables::table.cell>
        {{ $row->priority }}
    </x-livewire-tables::table.cell>

    <x-livewire-tables::table.cell>
        {{ $row->fragile }}
    </x-livewire-tables::table.cell>


    <x-livewire-tables::table.cell>
        @if($row->price!=0) {{ $row->price }} €/{{ $row->price_um }} @else - @endif
    </x-livewire-tables::table.cell>

    <x-livewire-tables::table.cell>
        @if($row->vendibile  == 1) 
            <button type="button"  class="btn btn-success  btn-sm" wire:click.stop.prevent="setVendibile({{$row}},0)"><i class="fas fa-check "></i></button>
        @else
            <button type="button" class="btn btn-danger btn-sm" wire:click.stop.prevent="setVendibile({{$row}},1)"><i class="fas fa-times bg-danger"></i>  </button>    
        @endif
    </x-livewire-tables::table.cell>

    <x-livewire-tables::table.cell>
        <div class="w-100 text-right">
            <a href="{{route('admin.piante.edit', $row['id'])}}" class="btn btn-sm btn-dark"><i class="fas fa-edit"></i></a>
            <button class="btn btn-outline-danger btn-sm" wire:click="confirmDelete({{ $row->id }})" data-toggle="tooltip"  title data-original-title="Cancella"><i class="fas fa-trash"></i></button>                    
        </div>
    </x-livewire-tables::table.cell> 
@endif