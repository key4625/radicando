<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if($showMode)    
        @include('backend.livewire.order.show')
    @else
        <div class="text-right mb-2">   
            <button class="btn btn-primary" type="button" wire:click="toggleInsert()"><i class="fas fa-plus"></i> Nuovo ordine </button> 
        </div>
        <table class="table  table-striped table-hover">
            <th>Nome</th><th class="">Per quando</th><th class="d-none d-lg-table-cell">Importo</th><th class="d-none d-lg-table-cell"></th><th class="d-none d-lg-table-cell"></th><th class="text-right" style="min-width: 110px;">Azioni</th>      
            @foreach($orders as $order)
                <tr>
                    <td>@if($order->consegna_domicilio) <i class="fas fa-home"></i> @endif {{$order->nome}}</td>
                    @if($confirming===$order->id)
                        <td colspan="4" class="text-right">
                            Vuoi cancellare?
                            <div class="btn-group ml-2" role="group" aria-label="Basic example">
                                <button wire:click="delete({{ $order->id }})" class="btn btn-danger hover:bg-red-600">Si</button>
                                <button wire:click="confirmDelete(0)"  class="btn btn-secondary hover:bg-red-600">No</button>
                            </div>
                        </td>
                    @else
                        <td >{{Carbon\Carbon::create($order->data)->translatedFormat('D d M')}} {{Carbon\Carbon::create($order->ora)->format('H:i')}}</td>
                        <td class="d-none d-lg-table-cell">{{$order->prezzo_tot}} € @if($order->sconto_perc > 0)  ({{$order->sconto_perc}}%) @endif</td>
                        <td class="d-none d-lg-table-cell text-center">
                            @if($order->evaso) <span class="mr-2" data-toggle="tooltip"  title data-original-title="Evaso" ><i class="fas fa-flag"></i></span> @else <button class="btn btn-primary rounded-circle mr-2" wire:click="setEvaso({{$order->id}})"><i class="far fa-flag"></i></button> @endif
                        </td>
                        <td class="d-none d-lg-table-cell text-center">
                            @if($order->pagato) <span class="mr-2" data-toggle="tooltip"  title data-original-title="Pagato" ><i class="fas fa-coins"></i></span> @else <button class="btn btn-warning text-white rounded-circle mr-2" wire:click="setPagato({{$order->id}})"><i class="fas fa-coins"></i></button> @endif
                        </td>
                        <td class="text-right" style="min-width: 160px;">
                            <button class="btn btn-primary" wire:click="toggleShow({{$order->id}})"><i class="fas fa-eye"></i></button>
                            @can('admin.orders.trash')
                                <button class="btn btn-outline-danger my-1" wire:click="confirmDelete({{ $order->id }})" data-toggle="tooltip"  data-original-title="Cancella"><i class="fas fa-trash"></i></button>                  
                            @endcan
                        </td>
                    @endif
                </tr>
            @endforeach
        </table>
    @endif
</div>

