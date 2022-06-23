<div class="bg-white">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="d-none d-md-block container-xxl py-4">
        <div class="row no-gutters">
            <div class="col-3"><button class="btn btn-muted btn-passo w-100 text-center" wire:click="$set('passo', '0')">1. Seleziona prodotti</button></div>
            <div class="col-3"><button class="btn btn-muted btn-passo w-100 text-center"  @if(count($item_ordered) == 0) disabled @endif wire:click="$set('passo', '1')" >2. Rivedi il tuo ordine ({{ count($item_ordered) }} pezzi)</button></div>
            <div class="col-3"><button class="btn btn-muted btn-passo w-100 text-center" @if(count($item_ordered) == 0) disabled @endif wire:click="$set('passo', '2')" >3. Dati anagrifici</button></div>
            <div class="col-3"><button class="btn btn-muted btn-passo w-100 text-center"  disabled   >4. Completa</button></div>
            <div class="col-12">
                <div class="progress">
                    <div class="progress-bar  bg-orange" role="progressbar" style="width: @if($passo==0) 25% @elseif($passo==1) 50% @elseif($passo==2) 75% @else 100% @endif" aria-valuenow="  @if($passo==0) 25 @elseif($passo==1) 50 @elseif($passo==2) 75 @else 100 @endif" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div> 
       
    </div>
    <div class="d-block d-md-none container-xxl bg-orange py-4">
        <div class="row no-gutters">
            <div class="col-12 text-center"><h3 class="h3 green text-uppercase">@if(count($item_ordered)==0) Seleziona prodotti @elseif($passo==4) Ordine concluso! @else  Il tuo ordine ({{ count($item_ordered) }} pezzi) @endif</h3></div>
            <div class="col-12">
                <div class="progress">
                    <div class="progress-bar  bg-green" role="progressbar" style="width: @if($passo==0) 25% @elseif($passo==1) 50% @elseif($passo==2) 75% @else 100% @endif" aria-valuenow="  @if($passo==0) 25 @elseif($passo==1) 50 @elseif($passo==2) 75 @else 100 @endif" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div> 
    </div>
    
    <div class="bg-lightgrey">
        <div class="container-xxl">  
            @if($passo==0)
                <div class="row">
                    <div class="col-12 mt-4">
                        <h5 class="text-center orange">Scegli tra una selezione dei</h5>
                        <h1 class="text-center green">NOSTRI PRODOTTI</h1>
                        <ul class="nav nav-pills nav-fill nav-product">
                            <li class="nav-item">      
                                <button class="nav-link @if($showProd == 0) active @endif" wire:click="viewProd(0)">Prodotti</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link @if($showProd == 1) active @endif" wire:click="viewProd(1)">Verdure</button>   
                            </li>
                        </ul>
                        <div class="tab-content my-4 py-4" style="border-top: 0.13rem solid #c1c1c1;">
                            <div class="tab-pane  @if($showProd == 0) show active fade @endif" wire:loading.class="fade">
                                <div class="row card-deck card-flip-container">
                                    @foreach($products_available as $product)
                                        <div class="col-6 col-lg-3 col-xl-2 mb-4">
                                            <div class="card card-flip mx-0 mb-4  @if(($showQuant==1)&&($idQuant==$product->id)&&($typeQuant=='product')) flipcard @endif " wire:key="prod-{{ $product->id }}" >
                                                @if(($showQuant==1)&&($idQuant==$product->id)&&($typeQuant=='product'))
                                                    <div class="card-body text-center back py-2">
                                                        <button class="btn btn-ghost-muted btn-sm" wire:click="resetQuantity"><i class="fas fa-times"></i></button>
                                                        <h5 class="mt-3 text-uppercase">{{$product->name}}</h5>
                                                        @if($product->price!=null) <span class="price">{{$product->price}}€</span> @endif
                                                        @if($product->dimension!=0) <span class="price">{{$product->dimension}}</span> @endif
                                                        <div class="input-group my-4">
                                                            {{--<label for="num" class="col-form-label mx-2">Quanti pezzi?</label>--}}
                                                            <input class="form-control d-inline" type="number" wire:model="quantity" default="0">
                                                            
                                                            <div class="input-group-append"><span class="input-group-text">{{$quantity_um}}</span></div>
                                                        </div>
                                                        <div class="input-group my-4">
                                                            @php ($arr_quant = explode(',',$quantity_um)) @endphp
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
                                                    <div class="card-body text-center front " wire:click="selProd({{$product->id}},'product','pz','{{$product->price_um}}')" >
                                                        <div class="d-flex align-items-center">
                                                            <img class="img-fluid" src="{{$product->getImage()}}" alt="{{$product->name}}">
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
                            <div class="tab-pane  @if($showProd == 1) show active fade @endif" wire:loading.class="fade">
                                <div class="row card-deck card-flip-container">
                                    @foreach($plants_available as $plant)
                                        <div class="col-6 col-lg-3 col-xl-2  mb-4">
                                            <div class="card card-flip mx-0 mb-4 @if(($showQuant==1)&&($idQuant==$plant->id)&&($typeQuant=='vegetable')) flipcard @endif " wire:key="plant-{{ $plant->id }}">
                                                @if(($showQuant==1)&&($idQuant==$plant->id)&&($typeQuant=='vegetable'))
                                                    <div class="card-body text-center back py-2">
                                                            <button class="btn btn-ghost-muted btn-sm" wire:click="resetQuantity"><i class="fas fa-times"></i></button>
                                                            <h5 class="mt-3 text-uppercase">{{$plant->nome}}</h5>
                                                            @if($plant->price!=null)
                                                                <span class="prezzo">{{$plant->price}}€/{{$plant->price_um}} </span>
                                                            @endif
                                                        <div class="input-group mt-4 mb-2">
                                                            <input class="form-control" type="number" wire:model="quantity" default="0">
                                                            <div class="input-group-append"><span class="input-group-text">{{$quantity_um}}</span></div>
                                                        </div>
                                                        <div class="input-group mt-2 mb-4">
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
                                                    <div class="card-body text-center front" wire:click="selProd({{$plant->id}},'vegetable','{{$plant->price_um}}','{{$plant->quantity_um}}')" >
                                                        <div class="d-flex align-items-center">
                                                            <img class="img-fluid" src="{{$plant->getImage()}}" alt="{{$plant->nome}}">
                                                        </div>
                                                        <h5 class="mt-3 text-uppercase">{{$plant->nome}}</h5>
                                                        @if($plant->price!=null)
                                                            <span class="prezzo">{{$plant->price}}€/{{$plant->price_um}} </span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> 
                        @if(count($item_ordered) > 0) 
                        <div class="text-center my-4">                          
                            <button class="btn btn-primary bordotondo px-4"  wire:click="$set('passo', '1')">Avanti <i class="fas fa-forward"></i></button>
                        </div>
                        @endif
                    </div>
                </div>
            @elseif($passo==1)
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3 my-4">
                        @if(count($item_ordered) > 0)
                            <h5 class="text-center orange">Fai il punto della situazione</h5>
                            <h1 class="text-center green">COSA STAI PRENOTANDO</h1>
                            <ul class="list-group  my-4 pb-0 pt-4 " style="border-top: 0.13rem solid #c1c1c1;"> 
                            
                                @foreach($item_ordered as $key=>$item_ord)
                                
                                    @if($item_ord['type'] == "vegetable")
                                        @php $tmp_item = App\Models\Plant::find($item_ord['item_id']) @endphp
                                    @else 
                                        @php $tmp_item = App\Models\Product::find($item_ord['item_id']) @endphp
                                    @endif
                                    <li class="list-group-item list-ordini">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-4">
                                            
                                                @if($tmp_item->image != null)
                                                    <img class="img-responsive" style="max-height:40px;" src="{{$tmp_item->image}}" alt="{{$tmp_item->nome}}">
                                                @else 
                                                    <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_item->nome}}">
                                                @endif   
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
                                                <button class="btn btn-danger-outline" wire:click="remove({{$key}})"><i class="fas fa-trash"></i></button>
                                            </div>       
                                        </div>    
                                    </li>
                                @endforeach
                            </ul>
                            <div class="text-center">
                                @if((!$ordine_non_completo)&&($ordine_tot > 0))
                                    Totale ordine: {{$ordine_tot}}€
                                @else 
                                    Totale ordine: -
                                @endif
                            </div>
                            <div class="text-center">
                                
                                   
                               
                                <button class="btn btn-sm btn-ghost-danger bordotondo px-4 text-center"  wire:click="resetInputFields"><i class="fas fa-trash"></i> Svuota ordine</button>
                            </div>
                        @endif 
                        <div class="text-center my-4">
                            <button class="btn btn-primary bordotondo px-4"  wire:click="$set('passo', '0')"><i class="fas fa-backward"></i> Indietro</button>
                            <button class="btn btn-primary bordotondo px-4"  wire:click="$set('passo', '2')">Avanti <i class="fas fa-forward"></i></button>
                        </div>
                    </div>
                </div>
            @elseif($passo==2)
                <div class="row">
                    <div class="col-12 my-4">
                        <h5 class="text-center orange">Completa la prenotazione</h5>
                        <h1 class="text-center green">INSERISCI I TUOI DATI</h1>
                        <div class="my-4" style="border-top: 0.13rem solid #c1c1c1;"> </div>
                        <div class="container">
                            <div class="row">
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
                                <div class="form-check my-2 col-12 col-md-12 text-center">
                                    <input class="form-check-input" type="checkbox" wire:model="consegna_domicilio" id="consegna_domicilio">
                                    <label class="form-check-label" for="consegna_domicilio">Consegna a domicilio</label>
                                </div>
                                @if($consegna_domicilio)
                                    <div class="form-group col-12 offset-md-4 col-md-4">
                                        <label for="indirizzo" class="col-form-label">Data di consegna</label>
                                        <input type="date" class="form-control senzabordo bordotondo" wire:model="data_consegna">
                                        @error('indirizzo') <span class="error text-danger">Data non valida</span> @enderror
                                    </div>
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
                            </div>
                        </div>
                        <div class="mt-4 text-center"> 
                            <button class="btn btn-primary bordotondo px-4"  wire:click="$set('passo', '1')"><i class="fas fa-backward"></i> Indietro </button>
                            <button wire:click="ordina" class="btn btn-primary bordotondo">Ordina</button>
                        </div>
                    </div>
                </div>
            @elseif($passo==3)
                <div class="row">
                    <div class="col-12 my-4">
                        <h5 class="text-center orange">Hai completato il processo</h5>
                        <h1 class="text-center green">GRAZIE PER LA TUA PRENOTAZIONE</h1>
                        <div class="my-4" style="border-top: 0.13rem solid #c1c1c1;"> </div>
                    </div>
                </div>
            @endif 
        </div>        
    </div> 
</div>

