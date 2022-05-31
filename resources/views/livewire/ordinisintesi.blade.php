<div>
    <div class="text-center my-2">
        <h3 class="d-inline">Ordini per </h3>
        <select class="form-control  d-inline w-auto" wire:model="filter_data">
            <option value="oggi">oggi</option>
            <option value="domani">domani</option>
            <option value="settimana">settimana</option>
        </select>
    </div>
    <div id="accordion">
        @foreach($orders->get() as $order)
            <div class="card mb-1">
                <div class="card-header p-2" id="heading-{{$order->id}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link  w-100 d-flex justify-content-between" data-toggle="collapse" data-target="#collapse-{{$order->id}}" aria-expanded="true" aria-controls="collapse-{{$order->id}}">
                            <div>@if($order->consegna_domicilio) <i class="fas fa-home mr-3"></i> @else <i class="fas fa-store mr-3"></i> @endif 
                                {{ $order->nome }} {{ $order->cognome }} - {{ $order->citta }}
                            </div>
                            <div> 
                                @if($order->evaso) <span class="mr-3" data-toggle="tooltip"  title data-original-title="Evaso" ><i class="fas fa-flag"></i></span> @endif
                                @if($order->pagato) <span class="mr-3" data-toggle="tooltip"  title data-original-title="Pagato" ><i class="fas fa-coins"></i></span> @endif
                            </div>
                            <div>{{ $order->plants->count() + $order->products->count()}} @if($order->prezzo_tot!=null)- {{$order->prezzo_tot}}€@endif</div> 
                        </button>
                    </h5>
                </div>
                <div id="collapse-{{$order->id}}" class="collapse" aria-labelledby="heading-{{$order->id}}" data-parent="#accordion">
                    <div class="card-body p-0">
                        <div class="w-100 text-center p-2">{{ $order->indirizzo }}</div>
                        <ul class="list-group list-group-flush"> 
                            @foreach($order->plants()->get() as $tmp_plant)           
                                <li class="list-group-item">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-3">
                                            
                                            @if($tmp_plant->image != null)
                                                <img class="img-responsive" style="max-height:40px;" src="{{$tmp_plant->image}}" alt="{{$tmp_plant->nome}}">
                                            @else 
                                                <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_plant->nome}}">
                                            @endif   
                                            
                                        </div>
                                        <div class="col-3">
                                            <label for="nome" class="col-form-label">{{$tmp_plant->nome}}</label>
                                        </div>
                                        <div class="col-3 ">
                                            {{$tmp_plant->pivot->quantity}} {{$tmp_plant->pivot->quantity_um}}
                                        </div>   
                                        <div class="col-3 ">
                                            {{$tmp_plant->pivot->price}} € / {{$tmp_plant->pivot->price_um}}
                                        </div>        
                                    </div>    
                                </li>
                            @endforeach
                            @foreach($order->products()->get() as $tmp_prod)           
                            <li class="list-group-item">
                                <div class="row g-3 align-items-center">
                                    <div class="col-3">
                                        @if($tmp_prod->image != null)
                                            <img class="img-responsive" style="max-height:40px;" src="{{$tmp_prod->image}}" alt="{{$tmp_prod->name}}">
                                        @else 
                                            <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_prod->name}}">
                                        @endif   
                                        
                                    </div>
                                    <div class="col-3">
                                        <label for="nome" class="col-form-label">{{$tmp_prod->name}}</label>
                                    </div>
                                    <div class="col-3 ">
                                        {{$tmp_prod->pivot->quantity}} {{$tmp_prod->pivot->quantity_um}}
                                    </div>   
                                    <div class="col-3 ">
                                        {{$tmp_prod->pivot->price}} € / {{$tmp_prod->pivot->price}}
                                    </div>        
                                </div>    
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
