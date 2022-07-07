
@if($showProd == 0)
<div class="clearfix">
    <button wire:click="$set('showMode', false)" class="float-right btn btn-primary"><i class="fas fa-backward"></i> Indietro</button>
</div>

<div class="row">
    <div class="col-12 col-md-6 my-4">
        <h1 class="text-center green">DATI CLIENTE</h1>
        <div class="my-4" style="border-top: 0.13rem solid #c1c1c1;"> </div>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6"><span>Id ordine: {{$this->sel_order->id}}</span></div>
                <div class="form-group col-12 col-md-6 text-right">
                    @if($this->sel_order->evaso) <span class="mr-2" data-toggle="tooltip"  title data-original-title="Evaso" wire:click="setEvaso({{$this->sel_order->id}},0,true)"><i class="fas fa-flag"></i></span> @else <button class="btn btn-primary rounded-circle mr-2" wire:click="setEvaso({{$this->sel_order->id}},1,true)"><i class="far fa-flag"></i></button> @endif
                    @if($this->sel_order->pagato) <span class="mr-2" data-toggle="tooltip"  title data-original-title="Pagato" wire:click="setPagato({{$this->sel_order->id}},0,true)"><i class="fas fa-coins"></i></span> @else <button class="btn btn-warning text-white rounded-circle mr-2" wire:click="setPagato({{$this->sel_order->id}},1,true)"><i class="fas fa-coins"></i></button> @endif
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="nome" class="col-form-label">Nome</label>
                    <input type="text" class="form-control senzabordo bordotondo" wire:model="nome" required>
                    @error('nome') <span class="error text-danger">Devi inserire un nome</span> @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="cognome" class="col-form-label">Cognome</label>
                    <input type="text" class="form-control senzabordo bordotondo" wire:model="cognome" required>
                    @error('cognome') <span class="error text-danger">Devi inserire un cognome</span> @enderror
                </div>
                <div class="form-group  col-12 col-md-6">
                    <label for="email" class="col-form-label">Email</label>
                    <input type="email" class="form-control senzabordo bordotondo" wire:model="email" >
                    @error('email') <span class="error text-danger">Devi inserire una email valida</span> @enderror
                </div>
                <div class="form-group  col-12 col-md-6">
                    <label for="tel" class="col-form-label">Numero di telefono</label>
                    <input type="text" class="form-control senzabordo bordotondo" wire:model="tel">
                    @error('tel') <span class="error text-danger">Telefono non valido</span> @enderror
                </div>
                <div class="col-12 col-xl-6 col-md-6 text-center text-md-left">
                    <label for="tipo_cliente" class="col-form-label">Tipo</label>
                    <select class="form-control" wire:model="tipo_cliente" wire:change="ricalcolaPrezzo">
                        <option value="privato">Privato</option>
                        <option value="rivenditore">Rivenditore</option>
                        <option value="gas">Gas</option>
                        <option value="dipendente">Dipendente</option>
                    </select>
                    @error('tipo_cliente') <span class="error text-danger">Tipo cliente non valido</span> @enderror
                </div>
                <div class="col-12 col-xl-6 col-md-6 text-center text-md-left">
                    <label for="nome" class="col-form-label">Data</label>
                    <input type="date" class="form-control" wire:model="data" required>
                </div>

                <div class="form-check my-2 col-12 col-md-12 text-center">
                    <input class="form-check-input" type="checkbox" wire:model="consegna_domicilio" id="consegna_domicilio">
                    <label class="form-check-label" for="consegna_domicilio">Consegna a domicilio</label>
                </div>
                @if($consegna_domicilio)
                    <div class="form-group  col-12 col-md-6">
                        <label for="indirizzo" class="col-form-label">Indirizzo di spedizione</label>
                        <input type="text" class="form-control senzabordo bordotondo" wire:model="indirizzo">
                        @error('indirizzo') <span class="error text-danger">Indirzzo non valido</span> @enderror
                    </div>
                    <div class="form-group  col-12 col-md-6">
                        <label for="citta" class="col-form-label">Città</label>
                        <input type="text" class="form-control senzabordo bordotondo" wire:model="citta">
                        @error('citta') <span class="error text-danger">Città non valida</span> @enderror
                    </div>
                @endif
                <div class="form-group  col-12">
                    <label for="notes" class="col-form-label">Note</label>
                    <textarea class="form-control senzabordo bordotondo" wire:model="notes"></textarea>
                    @error('notes') <span class="error text-danger">Note non valide</span> @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 my-4">
        
            <h1 class="text-center green">DETTAGLI ORDINE</h1>
            <div class="my-4" style="border-top: 0.13rem solid #c1c1c1;"> </div>
            @if(count($item_ordered) > 0)
                <ul class="list-group"> 
                    @foreach($item_ordered as $key=>$item_ord)           
                        @if($item_ord['type'] == "vegetable")
                            @php $tmp_item = App\Models\Plant::find($item_ord['item_id']) @endphp
                        @else 
                            @php $tmp_item = App\Models\Product::find($item_ord['item_id']) @endphp
                        @endif
                        <li class="list-group-item list-ordini">
                            <div class="row g-3 align-items-center">
                                <div class="col-4">
                                    <img class="img-responsive" style="max-height:40px;" src="{{$tmp_item->getImage()}}" alt="{{$tmp_item->nome}}">
                                    <label for="nome" class="col-form-label">@if($item_ord['type'] == "vegetable") {{$tmp_item->nome}} @else {{$tmp_item->name}} @endif</label>
                                </div>
                                <div class="col-3 ">
                                    <div class="input-group">
                                        <input class="form-control" type="number" wire:model="item_ordered.{{$key}}.quantity" default="0">
                                        <div class="input-group-append"><span class="input-group-text">{{$item_ord['quantity_um']}}</span></div>
                                    </div>
                                </div>

                                <div class="col-3 ">
                                    @if($item_ord['quantity_um']==$item_ord['price_um'])
                                        {{$item_ord['quantity']*$item_ord['price'] }} €
                                    @else 
                                    - 
                                    @endif
                                </div>
                            
                                <div class="col">
                                    <button class="btn btn-danger-outline" wire:click="remove({{$key}},'{{$item_ord['type']}}')"><i class="fas fa-trash"></i></button>
                                </div>       
                            </div>    
                        </li>
                    @endforeach
                </ul>
            @endif 
               
            <button class="btn btn-warning bordorotondo senzabordo btn-sm w-100 text-light my-2" wire:click="viewProd(1)">INSERISCI PRODOTTI</button>
            <div class="form-group row my-3">                  
                <label for="price_order" class="col-sm-4 col-form-label">Importo totale consigliato: {{$prezzo_tot_consigliato}}€ 
                    @if($sconto_perc > 0)<br> Con sconto {{$sconto_perc}}%: {{$prezzo_tot_consigliato_scontato}}€ @endif</label>
                <label for="price_order" class="col col-form-label text-right">TOTALE</label>
                <div class="col">   
                    <div class="input-group">
                        <input type="text" class="form-control" wire:model="prezzo_tot" >
                        <div class="input-group-append">
                            <span class="input-group-text" >€</span>
                        </div>
                    </div>
                </div>
                @error('prezzo_tot') <span class="error text-danger">Prezzo non valido</span> @enderror
            
            </div>
        
    </div> 
    <div class="col-12 mt-4 text-center">
            
        <button wire:click="ordina(1)" class="btn btn-primary">Salva</button>
        <button wire:click="ordina(2)" class="btn btn-primary">Salva e Nuovo</button>
        <button wire:click="ordina(3)" class="btn btn-primary">Salva e Rimani</button>
    </div>
</div>
@else
    <div class="card my-4">
        <div class="row">
            <div class="col-12 mt-4">
                <div class="clearfix">
                    <button wire:click="viewProd(0)" class="float-right mr-4 btn"><i class="fas fa-times"></i></button>
                </div>
                <h1 class="text-center green">AGGIUNGI PRODOTTO</h1>
                <ul class="nav nav-pills nav-fill nav-product">
                    <li class="nav-item">      
                        <button class="nav-link @if($showProd == 1) active @endif" wire:click="viewProd(1)">Prodotti</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link @if($showProd == 2) active @endif" wire:click="viewProd(2)">Verdure</button>   
                    </li>
                </ul>
                <div class="tab-content my-4 py-4" style="border-top: 0.13rem solid #c1c1c1;">
                    <div class="tab-pane  @if($showProd == 1) show active fade @endif" wire:loading.class="fade">
                        <div class="card-deck card-flip-container">
                            @foreach($products_available as $product)
                                <div class="col-6 col-lg-4 col-xl-3 mb-4">
                                    <div class="card card-flip mb-4  @if(($showQuant==1)&&($idQuant==$product->id)&&($typeQuant=='product')) flipcard @endif ">
                                        @if(($showQuant==1)&&($idQuant==$product->id)&&($typeQuant=='product'))
                                            <div class="card-body text-center back">
                                                <h5 class="mt-3 text-uppercase">{{$product->name}}</h5>
                                                @if($product->price!=null) <span class="price">{{$product->price}}€</span> @endif
                                                @if($product->dimension!=0) <span class="price">{{$product->dimension}}</span> @endif
                                                <div class="input-group my-4">
                                                    {{--<label for="num" class="col-form-label mx-2">Quanti pezzi?</label>--}}
                                                    <input class="form-control d-inline" type="number" wire:model="quantity" default="0">
                                                    <div class="input-group-append"><span class="input-group-text">{{$quantity_um}}</span></div>
                                                </div>
                                                <div class="input-group my-4">
                                                    @php ($arr_quant = explode(',',$product->quantity_um)) @endphp
                                                    @if(count($arr_quant) >1 )
                                                        <select class="form-control d-inline" wire:model="quantity_um">
                                                            @foreach($arr_quant as $sing_quant)
                                                                <option value="{{$sing_quant}}">{{$sing_quant}}</option>
                                                            @endforeach   
                                                        </select>
                                                    @endif
                                                </div>
                                                
                                                <button class="btn btn-primary" wire:click="add({{$product->id}},'product',{{$product->price}},'{{$product->price_um}}')">Aggiungi</button>
                                            </div>
                                        @else 
                                            <div class="card-body text-center front " wire:click="selProd({{$product->id}},'product','{{$product->price_um}}')" >
                                                <div class="d-flex align-items-center">
                                                    <img class="img-fluid" src="{{ $product->getImage() }}" alt="{{$product->name}}">
                                                </div>
                                                <h5 class="mt-3 text-uppercase">{{$product->name}}</h5>
                                                @if($product->price!=null)<span class="price">{{$product->price}}€</span> @endif
                                                @if($product->dimension!=0) <span class="price">{{$product->dimension}}</span> @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane  @if($showProd == 2) show active fade @endif" wire:loading.class="fade">
                        <div class="card-deck">
                            @foreach($plants_available as $plant)
                                <div class="col-6 col-lg-4 col-xl-3  mb-4">
                                    <div class="card card-flip mb-4 @if(($showQuant==1)&&($idQuant==$plant->id)&&($typeQuant=='vegetable')) flipcard @endif ">
                                        @if(($showQuant==1)&&($idQuant==$plant->id)&&($typeQuant=='vegetable'))
                                            <div class="card-body text-center back">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <h5 class="mt-3 text-uppercase">{{$plant->nome}}</h5>
                                                    @if($plant->price!=null)
                                                        <span class="prezzo">{{$plant->price}}€/kg </span>
                                                    @endif
                                                </div>
                                                <div class="input-group my-4">
                                                    <input class="form-control" type="number" wire:model="quantity" default="0">
                                                    <div class="input-group-append"><span class="input-group-text">{{$quantity_um}}</span></div>
                                                </div>
                                                <div class="input-group my-4">
                                                    @php ($arr_quant = explode(',',$plant->quantity_um)) @endphp
                                                    @if(count($arr_quant) >1 )
                                                        <select class="form-control d-inline" wire:model="quantity_um">
                                                            @foreach($arr_quant as $sing_quant)
                                                                <option value="{{$sing_quant}}">{{$sing_quant}}</option>
                                                            @endforeach   
                                                        </select>
                                                    @endif
                                                </div>
                                                <button class="btn btn-primary" wire:click="add({{$plant->id}},'vegetable',{{$plant->price}},'{{$plant->price_um}}')">Aggiungi</button>
                                            </div>
                                        @else 
                                            <div class="card-body text-center front" wire:click="selProd({{$plant->id}},'vegetable','{{$plant->price_um}}')" >
                                                <div class="d-flex align-items-center">
                                                    <img class="img-fluid" src="{{$plant->getImage()}}" alt="{{$plant->nome}}">                                                
                                                </div>
                                                <h5 class="mt-3 text-uppercase">{{$plant->nome}}</h5>
                                                @if($plant->price!=null)
                                                    <span class="prezzo">{{$plant->price}}€/kg </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> 
                <div class="text-center mb-4">
                    <button wire:click="viewProd(0)" class="btn btn-outline-primary"><i class="fas fa-times"></i> Chiudi</button>
                </div>
            </div>
        </div>
    </div>
@endif 

    
 
