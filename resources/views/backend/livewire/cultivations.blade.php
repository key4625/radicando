
<div class="row">
   
    <div class="col-6">
        <h3>Qui sarà possibile gestire le coltivazioni presenti e i trattamenti associati</h3>
        Seleziona terreno
        <select name="field_id" wire:model="field_id" class="form-control">
            <option value=''>Seleziona un terreno</option>
            @foreach($fields as $field)
                <option value={{ $field->id }}>{{ $field->name }}</option>
            @endforeach
        </select>
        @if(($this->points!=0)&&(count($this->points)>0)) Hai selezionato un lotto di {{ $mq }} mq @endif
        <br/> 
        Seleziona pianta
        <select name="plant_id" wire:model="plant_id" class="form-control">
            <option value=''>Seleziona una specie</option>
            @foreach($plants as $plant)
                <option value={{ $plant->id }}>{{ $plant->nome }}</option>
            @endforeach
        </select>
        <input type="text" wire:model="varieta" class="form-control">
      
    </div>
    <div class="col-6">
        <div wire:init="initMapContent" class="map-container" wire:ignore>
            <div id="map" class="mb-2"></div>
        </div> 
    </div>
   
</div>

