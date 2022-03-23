<div>
    @if($editMode)
       
            @if($operationtype_id==null)
                <div class="row">
                    @foreach($operationtypes as $otype)
                        <div class="col-4 col-xl-2">
                            <div class="card" wire:click="setOtype({{$otype->id}})">
                                <img class="card-img-top" src="/img/operazioni/{{$otype->icon}}" alt="{{$otype->name}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$otype->name}}</h5>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else 
                <div class="card">
                    <div class="card-header text-center"><img  height="40px" src="/img/operazioni/{{$operationtype_selected->icon}}" alt="{{$operationtype_selected->name}}"> Inserimento {{$operationtype_selected->name}}</div>
                    <div class="card-body row">
                        <div class="form-group col-12 col-md-6">
                            <label for="field_id">Seleziona terreno</label>
                            <select name="field_id" wire:model="field_id" class="form-control">
                                <option value=''>Seleziona un terreno o un lotto</option>
                                @foreach($fields as $field_tmp)
                                    <option value={{ $field_tmp['id'] }}>{{ $field_tmp['name'] }}</option>
                                @endforeach
                            </select>
                            @error('field_id') <span class="error text-danger">Devi selezionare un terreno</span> @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="cultivation_id">Seleziona una coltivazione</label>
                            <select name="cultivation_id" wire:model="cultivation_id" class="form-control">
                                <option value=''>Seleziona una coltivazione</option>
                                @foreach($cultivations as $cultiv_tmp)
                                    <option value={{ $cultiv_tmp->id }}>{{ $cultiv_tmp->plant->nome }}</option>
                                @endforeach
                            </select>
                            @error('cultivation_id') <span class="error text-danger">Devi selezionare una pianta</span> @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="name">Nome</label>
                            <input type="text" wire:model="name" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="tool">Attrezzo utilizzato</label>
                            <input type="text" wire:model="tool" class="form-control">
                        </div>
                        <div class="form-group col-4 col-xl-2">
                            <label for="quantity">Quantità</label>
                            <input type="number" wire:model="quantity" class="form-control">
                        </div>
                        <div class="form-group col-4 col-xl-2">
                            <label for="surface">Superficie</label>
                            <input type="number" wire:model="surface" class="form-control">
                        </div>
                        <div class="form-group col-4 col-xl-2">
                            <label for="duration">Duarata</label>
                            <input type="time" wire:model="duration" class="form-control">
                        </div>
                       
                        <div class="form-group col-6 col-xl-3">
                            <label for="date_start">Data inizio</label>
                            <input type="date" wire:model="date_start" class="form-control">
                        </div>
                        <div class="form-group col-6 col-xl-3">
                            <label for="date_end">Data fine</label>
                            <input type="date" wire:model="date_end" class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="description">Note aggiuntive</label>
                            <textarea wire:model="description" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary mt-2 w-100" wire:click="saveOperation"><i class="fas fa-save"></i> Salva</button>
                        </div>
                    </div>
                   
                </div>
            @endif
    @else
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Diario</div>
                    <div class="d-flex align-items-center">
                        
                    </div>
                    <div><button class="btn btn-primary" wire:click="toggleEdit"><i class="fas fa-plus"></i> Nuova operazione</button></div>
                </div>
            </div>
            <div class="card-body"> 
            </div>
        </div>
    @endif
</div>
