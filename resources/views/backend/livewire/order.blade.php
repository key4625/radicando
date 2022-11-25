<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if($showMode)    
        @include('backend.livewire.order.show')
    @else
    
        <div class="row">
            <div class="col-12">
                <div class="text-right mb-2">   
                    <button class="btn btn-primary" type="button" wire:click="toggleInsert()"><i class="fas fa-plus"></i> Nuovo ordine </button> 
                </div>   
            </div>
           
            <div class="col my-3">
                <div class="form-group"> 
                    <label>Filtra per consegna</label>
                    <select class="form-control" wire:model="filter_consegnato">
                        <option value="da_consegnare">da consegnare</option>
                        <option value="consegnati">consegnati</option>
                        <option value="tutti">tutti</option>
                    </select>
                </div>
            </div>
            <div class="col  my-3">
                <div class="form-group"> 
                    <label>Filtra per pagamento</label>
                    <select class="form-control" wire:model="filter_pagato">
                        <option value="da_pagare">da pagare</option>
                        <option value="pagati">pagati</option>
                        <option value="tutti">tutti</option>
                    </select>
                </div>
            </div>
            <div class="col  my-3">
                <div class="form-group">
                    <label>A partire dal </label>
                    <input wire:model="filter_data" type="date" class="form-control">
                </div>
            </div>
            <div class="col  my-3">
                <div class="form-group">
                    <label>al </label>
                    <input wire:model="filter_data_al" type="date" class="form-control">
                </div>
            </div>
            <div class="col  my-3">
                <div class="form-group">
                    <label>cerca</label>
                    <input wire:model="filter_testo" type="text" class="form-control">
                </div>
            </div>
            <div class="col my-3">
                <div class="form-group float-right">
                    <label>&nbsp;</label>
                </div>
            </div>
           
        </div>
        <div class="table-responsive">
            <table class="table  table-striped table-hover">
                <th>N°</th><th>Consegna</th><th>Nome</th><th class="">Per quando</th>
                <th wire:click="sortBy('citta')" style="cursor:pointer;">Città 
                    @if(($sortedby =="citta")&&( $sortdir == "asc"))<i class="fas fa-sort-up green"></i>
                    @elseif(($sortedby =="citta")&&( $sortdir == "desc"))<i class="fas fa-sort-down green"></i>
                    @else <i class="fas fa-sort"></i>
                    @endif
                </th>
                <th class="d-none d-lg-table-cell">Importo</th>
                <th class="text-center">Consegnato</th>
                <th class=" text-center">Pagato</th>
                <th class="text-right" style="min-width: 110px;">Azioni</th>      
            
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>@if($order->consegna_domicilio) <i class="fas fa-home"></i> @else <i class="fas fa-store"></i> @endif</td>
                        <td>{{$order->nome}}  {{$order->cognome}}</td>
                        @if($confirming===$order->id)
                            <td colspan="6" class="text-right">
                                Vuoi cancellare?
                                <div class="btn-group ml-2" role="group" aria-label="Basic example">
                                    <button wire:click="delete({{ $order->id }})" class="btn btn-danger hover:bg-red-600">Si</button>
                                    <button wire:click="confirmDelete(0)"  class="btn btn-secondary hover:bg-red-600">No</button>
                                </div>
                            </td>
                        @else
                            <td >{{Carbon\Carbon::create($order->data)->translatedFormat('D d M')}} </td>
                            <td>{{$order->citta}}</td>
                            <td class="d-none d-lg-table-cell">{{$order->prezzo_tot}} € @if($order->sconto_perc > 0)  ({{$order->sconto_perc}}%) @endif</td>
                            <td class="text-center">
                                @if($order->evaso) <span class="mr-2" data-toggle="tooltip"  title data-original-title="Evaso" wire:click="setEvaso({{$order->id}},0,false)"><i class="fas fa-flag"></i></span> @else <button class="btn btn-primary rounded-circle mr-2" wire:click="setEvaso({{$order->id}},1,false)"><i class="far fa-flag"></i></button> @endif
                            </td>
                            <td class="text-center">
                                @if($order->pagato) <span class="mr-2" data-toggle="tooltip"  title data-original-title="Pagato" wire:click="setPagato({{$order->id}},0,false)" ><i class="fas fa-coins"></i></span> @else <button class="btn btn-warning text-white rounded-circle mr-2" wire:click="setPagato({{$order->id}},1,false)"><i class="fas fa-coins"></i></button> @endif
                            </td>
                            <td class="text-right" style="min-width: 160px;">
                                <button class="btn btn-primary" wire:click="toggleShow({{$order->id}})"><i class="fas fa-edit"></i></button>
                                @can('admin.orders.trash')
                                    <button class="btn btn-outline-danger my-1" wire:click="confirmDelete({{ $order->id }})" data-toggle="tooltip"  data-original-title="Cancella"><i class="fas fa-trash"></i></button>                  
                                @endcan
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="text-center">{{$orders->links()}}</div>
        @include('backend.livewire.order.print')
    @endif
</div>

@push('after-scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {

            @this.on('triggerOrdina', azione => {
                if(azione[1] == 1){
                    Swal.fire({
                        title: 'Aggiornare il totale?',
                        text: 'Il totale ordine calcolato di '+ azione[2] +'€ è diverso da quello indicato di '+ azione[3] + '€ , aggiornarlo?',
                        type: "warning",
                        showCancelButton: true,
                      
                        confirmButtonText: 'Si',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        //if user clicks on salva prezzo
                        if (result.value) {
                            // calling destroy method to delete
                            @this.call('ordina',azione[0],1)
                            // success response
                            responseAlert({title: session('message'), type: 'success'});
                            
                        } else {
                            @this.call('ordina',azione[0],0)
                            responseAlert({
                                title: 'Operation Cancelled!',
                                type: 'success'
                            });
                        }
                    });
                } else  @this.call('ordina',azione[0],0)
            });
        })
    </script>
@endpush

