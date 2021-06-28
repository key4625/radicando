<div>
    <h1>Prenota ora</h1>
    <span>L'orto è sempre in divenire, qui trovi i prodotti attualmente disponibili</span>
    <div class="row">
        <div class="col-12 col-md-4 text-center">
            <label for="nome" class="col-form-label">Nome</label>
            <input type="text" class="form-control" wire:model="nome" required>
            @error('nome') <span class="error text-danger">Devi inserire un nome</span> @enderror
        </div>
        <div class="col-12 col-md-4  text-center">
            <label for="email" class="col-form-label">Email</label>
            <input type="email" class="form-control" wire:model="email" required>
            @error('email') <span class="error text-danger">Devi inserire una email valida</span> @enderror
        </div>
        <div class="col-12 col-md-4  text-center">
            <label for="tel" class="col-form-label">Tel</label>
            <input type="text" class="form-control" wire:model="tel" required>
            @error('tel') <span class="error text-danger">Telefono non valido</span> @enderror
        </div>
    </div>
    <div class="my-4">
        <h3>Seleziona quello che ti interessa</h3>
        @foreach($plants_available as $plant)
            <span class="badge badge-primary" wire:click="add({{$plant->id}})">{{$plant->nome}} @if($plant->prezzo_kg!=null){{$plant->prezzo_kg}}€/kg @endif</span>
        @endforeach
    </div>
    <div>
      
        @if(count($plant_ordered) > 0)
            <h3>Stai ordinando</h3>
            <ul class="list-group">           
                @foreach($plant_ordered as $plant_ord)
                
                    <li class="list-group-item">
                        <div class="row g-3 align-items-center">
                            <div class="col-4">
                            <label for="inputPassword6" class="col-form-label">{{App\Models\Plant::find($plant_ord)->nome}} </label>
                            
                            </div>
                            <div class="col-auto">
                                <div class="input-group">
                                    <input class="form-control" type="number" wire:model="quantity_kg.{{$plant_ord}}" default="0">
                                    <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                                    <label for="inputPassword6" class="col-form-label mx-2"> oppure n°</label>
                                    <input class="form-control d-inline" type="number" wire:model="quantity_num.{{$plant_ord}}" default="0">
                                </div>
                            </div>
                        
                        
                        </div>
                        
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="mt-4 text-center">
        <button wire:click="ordina" class="btn btn-primary">Ordina</button>
    </div>
    
</div>