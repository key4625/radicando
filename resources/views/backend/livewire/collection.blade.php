<div>
    <div class="row justify-content-md-center">
        @if($plant_collected == 0)
            <div class="col-12 mb-4">
                <h3 class="mb-4">Seleziona la pianta che hai raccolto</h3>
                <div class="row">
                    @foreach($plants_available as $plant)
                        <div class="card-group col-12 col-md-3 col-xl-2">
                            <div class="card mb-4" wire:click="add({{$plant->id}})">
                                @if($plant->image != null)
                                    <img class="card-img-top" src="{{$plant->image}}" alt="{{$plant->nome}}">
                                @else 
                                    <img class="card-img-top" src="/img/img-placeholder.png" alt="{{$plant->nome}}">
                                @endif    
                                <div class="card-body text-center">
                                    <h4>{{$plant->nome}} </h4>
                                    <div class="row">
                                        <div class="col-12">
                                            Raccolti oggi {{$plant->raccolti_oggi_kg()}} kg ({{$plant->raccolti_oggi_nr()}} pezzi)
                                        </div>
                                        <div class="col-12">
                                            Raccolti in totale {{$plant->raccolti_tot_kg()}} kg ({{$plant->raccolti_tot_nr()}} pezzi)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>       
                    @endforeach
                </div>
            </div>
        @else 
            <div class="col-12">
                <div class="float-left"><h3>Stai raccogliendo {{$plant_name}}</h3> </div>
                <div class="float-right"><button wire:click="resetInputFields()" class="btn btn-secondary"><i class="fas fa-step-backward"></i> Annulla</button></div>
            </div>
            <div class="col-12 col-md-3 col-xl-2 my-4">     

                <div class="card m-auto">
                    @if($plant_image != null)
                            <img class="card-img-top" src="{{$plant_image}}" alt="{{$plant_name}}">
                        @else 
                            <img class="card-img-top" src="/img/img-placeholder.png" alt="{{$plant_name}}">
                        @endif   
                    <div class="card-body text-center">
                        <h3 class="col-form-label">{{$plant_name}} </h3> 
                        <div class="input-group">
                            <input class="form-control" type="number" wire:model="quantity_kg" default="0">
                            <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                        
                        </div>
                        <div class="">
                            <label for="num" class="col-form-label mx-2"> oppure n°</label>
                            <input class="form-control d-inline" type="number" wire:model="quantity_num" default="0">
                        </div>
                        <div class="mt-4 text-center">                    
                            <button wire:click="raccogli" class="btn btn-primary">Raccogli</button>
                        </div>
                    </div>
                    
                </div>   
            </div>
        @endif
        
    </div>
    
</div>