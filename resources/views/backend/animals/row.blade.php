
<td>
    @if( $row->image !=null)
        <img class="img-responsive" src="{{ $row->image }}" style="height:45px;">
    @else 
        <img class="img-responsive" src="/img/img-placeholder.png"  style="height:45px;">
    @endif
</td> 

<x-livewire-tables::table.cell>
    {{ $row->nome }}
</x-livewire-tables::table.cell>


<x-livewire-tables::table.cell>
    @if($row->vendibile  == 1) 
        <button class="btn btn-success  btn-sm"><i class="fas fa-check "></i></button>
    @else
    <button class="btn btn-danger btn-sm"><i class="fas fa-times bg-danger"></i>  </button>    
    
    @endif
</x-livewire-tables::table.cell>