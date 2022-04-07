<div>
    <div class="row justify-content-md-center">
        @if($collectionable_id == 0)
            <div class="col-12 mb-4">
                <h3 class="mb-4">Seleziona la pianta che hai raccolto</h3>
                <div class="row">
                    @foreach($plants_available as $plant)
                        <div class="card-group col-12 col-md-3 col-xl-2">
                            <div class="card mb-4" wire:click="add({{$plant->id}},1)">
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

            <div class="col-12 mb-4">
                <h3 class="mb-4">Seleziona animale</h3>
                <div class="row">
                    @foreach($animals_available as $animal)
                        <div class="card-group col-12 col-md-3 col-xl-2">
                            <div class="card mb-4" wire:click="add({{$animal->id}},2)">
                                @if($animal->image != null)
                                    <img class="card-img-top" src="{{$animal->image}}" alt="{{$animal->nome}}">
                                @else 
                                    <img class="card-img-top" src="/img/img-placeholder.png" alt="{{$animal->nome}}">
                                @endif    
                                <div class="card-body text-center">
                                    <h4>{{$animal->nome}} </h4>
                                    <div class="row">
                                        <div class="col-12">
                                            Raccolti oggi {{$animal->raccolti_oggi_kg()}} kg ({{$animal->raccolti_oggi_nr()}} pezzi)
                                        </div>
                                        <div class="col-12">
                                            Raccolti in totale {{$animal->raccolti_tot_kg()}} kg ({{$animal->raccolti_tot_nr()}} pezzi)
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
                <div class="float-left"><h3>Stai raccogliendo {{$name}}</h3> </div>
                <div class="float-right"><button wire:click="resetInputFields()" class="btn btn-secondary"><i class="fas fa-step-backward"></i> Annulla</button></div>
            </div>
            <div class="col-12 col-md-3 col-xl-2 my-4">     

                <div class="card m-auto">
                    @if($image != null)
                            <img class="card-img-top" src="{{$image}}" alt="{{$name}}">
                        @else 
                            <img class="card-img-top" src="/img/img-placeholder.png" alt="{{$name}}">
                        @endif   
                    <div class="card-body text-center">
                        <h3 class="col-form-label">{{$name}} </h3> 
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