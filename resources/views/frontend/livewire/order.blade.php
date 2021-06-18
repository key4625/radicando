<div>
    <h1>Prenota ora</h1>
    <span>L'orto è sempre in divenire, qui trovi i prodotti attualmente disponibili</span>
    <div>
        @foreach($plants_available as $plant)
            <span class="badge badge-primary" wire:click="add({{$plant->id}})">{{$plant->nome}} @if($plant->prezzo_kg!=null){{$plant->prezzo_kg}}€/kg @endif</span>
        @endforeach
    </div>
    <div>
        <h3>Stai ordinando</h3>
        
        <ul class="list-group">
            @foreach($plant_ordered as $plant_id)
                <li class="list-group-item">
                    <div class="row g-3 align-items-center">
                        <div class="col-4">
                          <label for="inputPassword6" class="col-form-label">{{App\Models\Plant::find($plant_id)->nome}} </label>
                        </div>
                        <div class="col-auto">
                            <div class="input-group">
                                <input class="form-control" type="number" name="quantity_kg[{{$plant_id}}]" default="0">
                                <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                            </div>
                        </div>
                      
                        <div class="col-auto">
                            <label for="inputPassword6" class="col-form-label"> oppure n°</label>
                          </div>
                        <div class="col-auto">
                            <input class="form-control d-inline" type="number" name="quantity_num[{{$plant_id}}]" default="0">
                        </div>
                      
                      </div>
                     
                </li>
            @endforeach
        </ul>
    </div>
    <div class="mt-4 text-center">
        <button wire:click="ordina" class="btn btn-primary">Ordina</button>
    </div>
    
</div>