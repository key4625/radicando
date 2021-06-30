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
    <div class="row">
        <div class="col-12 col-md-6 my-4">
            <h3>Seleziona quello che ti interessa</h3>
            <div class="row">
                @foreach($plants_available as $plant)
                    <div class="card-group col-6 col-md-4">
                        <div class="card mb-4" wire:click="add({{$plant->id}})">
                            @if($plant->image != null)
                                <img class="card-img-top" src="{{$plant->image}}" alt="{{$plant->nome}}">
                            @else 
                                <img class="card-img-top" src="/img/img-placeholder.png" alt="{{$plant->nome}}">
                            @endif    
                            <div class="card-body text-center">{{$plant->nome}} @if($plant->prezzo_kg!=null)<br />{{$plant->prezzo_kg}}€/kg @endif</div>
                        </div>
                    
                    </div>
                
                @endforeach
            </div>
        </div>
       
        <div class="col-12 col-md-6 my-4">
            @if(count($plant_ordered) > 0)
                <h3>Stai ordinando</h3>
                <ul class="list-group"> 
                  
                    @foreach($plant_ordered as $plant_ord)
                        @php $tmp_plant = App\Models\Plant::find($plant_ord) @endphp
                        <li class="list-group-item">
                            <div class="row g-3 align-items-center">
                                <div class="col-4">
                                 
                                    @if($tmp_plant->image != null)
                                        <img class="img-responsive" style="max-height:40px;" src="{{$tmp_plant->image}}" alt="{{$tmp_plant->nome}}">
                                    @else 
                                        <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_plant->nome}}">
                                    @endif   
                                    <label for="nome" class="col-form-label">{{$tmp_plant->nome}} </label>
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <input class="form-control" type="number" wire:model="quantity_kg.{{$plant_ord}}" default="0">
                                        <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                                        <label for="num" class="col-form-label mx-2"> oppure n°</label>
                                        <input class="form-control d-inline" type="number" wire:model="quantity_num.{{$plant_ord}}" default="0">
                                        <button class="btn btn-danger-outline" wire:click="remove({{$plant_ord}})"><i class="fas fa-trash"></i></button>
                                    </div>
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
    
</div>