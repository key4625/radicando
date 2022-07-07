<div>
    <div class="text-center my-2 row form-inline">
        <div class="col-12"><h3>Ordini</h3></div>
        <div class="col-12 col-md-6"><span>dal </span><input type="date" wire:model="filter_data" class="form-control d-inline w-auto"></div>
        <div class="col-12 col-md-6"> <span>al </span><input type="date" wire:model="filter_data2" class="form-control d-inline w-auto"></div>
      
      
       
      
        {{--<select class="form-control  d-inline w-auto" wire:model="filter_data">
            <option value="oggi">oggi</option>
            <option value="domani">domani</option>
            <option value="settimana">settimana</option>
        </select>--}}
    </div>
    <div id="accordion">
        @foreach($orders as $order)
            <div class="card mb-1">
                <div class="card-header p-2" id="heading-{{$order->id}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link  w-100 d-flex justify-content-between" data-toggle="collapse" data-target="#collapse-{{$order->id}}" aria-expanded="true" aria-controls="collapse-{{$order->id}}">
                            <div>@if($order->consegna_domicilio) <i class="fas fa-home mr-3"></i> @else <i class="fas fa-store mr-3"></i> @endif 
                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $order->data)->format('d-m')}}
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
                                            <img class="img-responsive" style="max-height:40px;" src="{{$tmp_plant->getImage()}}" alt="{{$tmp_plant->nome}}"> 
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
                                            <img class="img-responsive" style="max-height:40px;" src="{{Storage::url($tmp_prod->image)}}" alt="{{$tmp_prod->name}}">
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
    <div class="text-center">{{$orders->links()}}</div>
</div>
