
<td>
    <img class="img-responsive" src="{{ $row->getImage() }}" style="height:45px;">
</td> 

<x-livewire-tables::table.cell>
    {{ $row->name }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{$row->nome_cat}} 
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->quantity_mag }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->dimension }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->fragile }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->price }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->vendibile  == 1) 
        <button type="button"  class="btn btn-success  btn-sm" wire:click.stop.prevent="setVendibile({{$row}},0)"><i class="fas fa-check "></i></button>
    @else
        <button type="button" class="btn btn-danger btn-sm" wire:click.stop.prevent="setVendibile({{$row}},1)"><i class="fas fa-times bg-danger"></i>  </button>    
    @endif
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    <a href="{{route('admin.prodotti.edit', $row['id'])}}" class="btn btn-sm btn-dark"><i class="fas fa-edit"></i></a>
</x-livewire-tables::table.cell>