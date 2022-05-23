<div>
    <h1 class="mt-4">Prenota ora</h1>
    <span>L'orto è sempre in divenire, qui trovi i prodotti attualmente disponibili</span>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    
    <div class="row">
        <div class="col-12">
            <h3>Seleziona quello che ti interessa</h3>
            <ul class="nav nav-tabs">
                <li class="nav-item">      
                    <button class="nav-link @if($showProd == 0) active @endif" wire:click="viewProd(0)">Prodotti</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link @if($showProd == 1) active @endif" wire:click="viewProd(1)">Verdure</button>   
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane  @if($showProd == 0) show active fade @endif" wire:loading.class="fade">
                    <div class="card-deck p-4">
                        @foreach($products_available as $product)
                            <div class="card mb-4" wire:click="add({{$product->id}},'product')">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center" style="min-height: 130px;">
                                        @if($product->image != null)
                                            <img class="img-fluid" src="{{$product->image}}" alt="{{$product->name}}">
                                        @else 
                                            <img class="img-fluid" src="/img/img-placeholder.png" alt="{{$product->name}}">
                                        @endif    
                                    </div>
                                    {{$product->name}} @if($product->prezzo_kg!=null)<br />{{$product->prezzo_kg}}€/kg @endif
                                </div>
                            </div>  
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane  @if($showProd == 1) show active fade @endif" wire:loading.class="fade">
                    <div class="card-deck p-4">
                        @foreach($plants_available as $plant)
                            <div class="card mb-4" wire:click="add({{$plant->id}},'vegetable')">
                                <div class="card-body text-center">
                                    <div class="d-flex align-items-center" style="min-height: 130px;">
                                        @if($plant->image != null)
                                            <img class="img-fluid" src="{{$plant->image}}" alt="{{$plant->nome}}">
                                        @else 
                                            <img class="img-fluid" src="/img/img-placeholder.png" alt="{{$plant->nome}}">
                                        @endif    
                                    </div>
                                    {{$plant->nome}} @if($plant->prezzo_kg!=null)<br />{{$plant->prezzo_kg}}€/kg @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 my-4">
            @if(count($item_ordered) > 0)
                <h3>Stai ordinando</h3>
                <ul class="list-group"> 
                  
                    @foreach($item_ordered as $item_ord)
                    
                        @if($item_ord['type'] == "vegetable")
                            @php $tmp_item = App\Models\Plant::find($item_ord['item_id']) @endphp
                        @else 
                            @php $tmp_item = App\Models\Product::find($item_ord['item_id']) @endphp
                        @endif
                        <li class="list-group-item">
                            <div class="row g-3 align-items-center">
                                <div class="col-4">
                                 
                                    @if($tmp_item->image != null)
                                        <img class="img-responsive" style="max-height:40px;" src="{{$tmp_item->image}}" alt="{{$tmp_item->nome}}">
                                    @else 
                                        <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_item->nome}}">
                                    @endif   
                                    <label for="nome" class="col-form-label">{{$tmp_item->nome}} </label>
                                </div>
                                <div class="col-3 ">
                                    <div class="input-group">
                                        <input class="form-control" type="number" wire:model="item_ordered.{{$item_ord['id']}}.quantity_kg" default="0">
                                        <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        {{--<label for="num" class="col-form-label mx-2">Quanti pezzi?</label>--}}
                                        <input class="form-control d-inline" type="number" wire:model="item_ordered.{{$item_ord['id']}}.quantity_num" default="0">
                                        <div class="input-group-append"><span class="input-group-text">Pz</span></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger-outline" wire:click="remove({{$item_ord['id']}})"><i class="fas fa-trash"></i></button>
                                </div>       
                            </div>    
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 text-center">
                  
                    <button wire:click="ordina" class="btn btn-primary">Ordina</button>
                </div>
            @endif  
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-4 text-center text-md-left">
            <label for="nome" class="col-form-label">Nome</label>
            <input type="text" class="form-control" wire:model="nome" required>
            @error('nome') <span class="error text-danger">Devi inserire un nome</span> @enderror
        </div>
        <div class="col-12 col-md-4  text-center text-md-left">
            <label for="email" class="col-form-label">Email</label>
            <input type="email" class="form-control" wire:model="email" >
            @error('email') <span class="error text-danger">Devi inserire una email valida</span> @enderror
        </div>
        <div class="col-12 col-md-4  text-center text-md-left">
            <label for="tel" class="col-form-label">Tel</label>
            <input type="text" class="form-control" wire:model="tel">
            @error('tel') <span class="error text-danger">Telefono non valido</span> @enderror
        </div>
    </div>
    
</div>

