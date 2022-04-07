<div>
    @if($editMode)
        <div class="card">
            <div class="card-body row">       
                <div class="col-6">
                    @if($cult_id==null)<h3>Nuova coltivazione</h3>
                    @else <h3>Modifica coltivazione</h3>
                    @endif
                    <form class="mt-4" action="">
                        <div class="form-group">
                            <label for="field_id"> Seleziona terreno</label>
                            <select name="field_id" wire:model="field_id" class="form-control">
                                <option value=''>Seleziona un terreno</option>
                                @foreach($fields as $tmp_field)
                                   
                                    <option value={{ $tmp_field['id'] }}>{{ $tmp_field['name'] }}</option>
                                @endforeach
                            </select>
                            @error('field_id') <span class="error text-danger">Devi selezionare un terreno</span> @enderror
                            @if(($this->points!=0)&&(count($this->points)>0)) <small id="emailHelp" class="form-text text-muted">Hai selezionato un lotto di {{ $superficie_tot }} mq @if($field_id != null) di {{ $field_sel->mq }} mq totali</small>@endif  @endif
                        </div>    
                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                @if($cultivable_type == "App\Models\Plant")
                                    <label for="cultivable_id">Seleziona pianta</label>
                                    <select name="cultivable_id" wire:model="cultivable_id" class="form-control">
                                        <option value=''>Seleziona una specie</option>
                                        @foreach($plants as $plant)
                                            <option value={{ $plant->id }}>{{ $plant->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('cultivable_id') <span class="error text-danger">Devi selezionare una pianta</span> @enderror
                                @else 
                                    <label for="cultivable_id">Seleziona un animale</label>
                                    <select name="cultivable_id" wire:model="cultivable_id" class="form-control">
                                        <option value=''>Seleziona un animale</option>
                                        @foreach($animals as $animal)
                                            <option value={{ $animal->id }}>{{ $animal->nome }}</option>
                                        @endforeach
                                    </select>
                                    @error('cultivable_id') <span class="error text-danger">Devi selezionare un animale</span> @enderror
                                @endif
                            </div>
                            <div class="form-group col-12 col-md-3">
                                <label for="varieta">@if($cultivable_type == "App\Models\Plant")Varietà @else Razza @endif</label>
                                <input type="text" wire:model="varieta" class="form-control">
                            </div>
                            @if($cultivable_type == "App\Models\Plant")
                                <div class="form-group col-12 col-md-3">
                                    <label for="innesto">Innesto</label>
                                    <input type="text" wire:model="innesto" class="form-control">
                                </div> 
                            @endif  
                        
                            <div class="form-group col-12 col-md-6">
                                <label for="data_inizio">Data inizio</label>
                                <input type="date" wire:model="data_inizio" class="form-control">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label for="data_fine">Data fine</label>
                                <input type="date" wire:model="data_fine" class="form-control">
                            </div>
                        
                        </div>
                        <button type="button" class="btn btn-primary mt-2 w-100" wire:click="saveCultivation"><i class="fas fa-save"></i> Salva</button>
                    </form>
                
                </div>
                <div class="col-6">
                    <button type="button" class="close pb-2" data-dismiss="modal" aria-label="Close" wire:click="toggleEdit(0)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div wire:init="initMapContent" class="map-container" wire:ignore>
                        <div id="map" class="mb-2"></div>
                    </div> 
                </div>
            </div>
        </div>
    @else

   
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Coltivazioni</div>
                    <div class="d-flex align-items-center">
                        <span class="mr-2">Mostra coltivazioni passate</span>
                        <label class="c-switch c-switch-pill c-switch-info">  
                            <input class="c-switch-input" type="checkbox" checked="" wire:model="mostraTutti" wire:change="initIndexMapContent"><span class="c-switch-slider"></span>
                        </label>
                    </div>
                    <div><button class="btn btn-primary" wire:click="toggleEdit(2)"><i class="fas fa-plus"></i> Nuovo allevamento</button> <button class="btn btn-primary" wire:click="toggleEdit(1)"><i class="fas fa-plus"></i> Nuova coltivazione</button></div>
                </div>
            </div>
            @if(!$this->mostraTutti)
            <div wire:init="initIndexMapContent" class="map-index-container">
                <div id="map-index" class="mb-2"></div>
            </div>   
            @endif
            <div class="card-body"> 
               
                @if($cultivations!=null)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            @foreach($cultivations as $single_cult)
                                <tr >
                                    <td>@if($single_cult->cultivable->image != null)<img class="img-fluid" style="height:50px;" src="{{ $single_cult->cultivable->image }}">@else <img class="img-fluid" style="height:50px;" src="/img/img-placeholder.png">@endif</td>
                                    <td>{{ $single_cult->cultivable->nome }}<br><span>{{ $single_cult->varieta }}</span></td>
                                    <td>@if($single_cult->data_inizio!=null){{ Carbon\Carbon::parse($single_cult->data_inizio )->format('d M Y')}}@else non prevista @endif</td>
                                    <td>{!! $single_cult->getFormattedDataFine() !!}</td>
                                    <td>{{ $single_cult->field->name }}</td>
                                    <td class="text-right">
                                        <button class="btn btn-dark" wire:click="setCultivation({{$single_cult->id}})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger" wire:click="$emit('deleteTriggered',{{$single_cult->id}},'{{$single_cult->cultivable->nome}}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{ $cultivations->links() }}
                @endif  
            </div>
        </div>
    @endif
</div>

