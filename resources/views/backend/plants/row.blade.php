
<td>
    <img class="img-responsive" src="{{ $row->getImage() }}" style="height:45px;">
</td> 

<x-livewire-tables::table.cell>
    {{ $row->nome }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{$row->nome_cat}} 
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    {{ $row->resa_pianta_kg }}
</x-livewire-tables::table.cell>


<x-livewire-tables::table.cell>
    {{ $row->prezzo_kg }}
</x-livewire-tables::table.cell>

<x-livewire-tables::table.cell>
    @if($row->vendibile  == 1) 
        <button class="btn btn-success  btn-sm"><i class="fas fa-check "></i></button>
    @else
    <button class="btn btn-danger btn-sm"><i class="fas fa-times bg-danger"></i>  </button>    
    
    @endif
</x-livewire-tables::table.cell>