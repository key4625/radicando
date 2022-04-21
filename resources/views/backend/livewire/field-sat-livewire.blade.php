
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div><a class="btn btn-sm" href="/admin/terreni"><i class="fas fa-home"></i></a> Terreni</div>     
                <div>
                    <select name="field_id" wire:model="field_id" wire:change="initMapIndexContent" class="form-control">
                        <option value=''>Seleziona un terreno</option>
                        @foreach($fields as $tmp_field)
                           
                            <option value={{ $tmp_field['id'] }}>{{ $tmp_field['name'] }}</option>
                        @endforeach
                    </select>
                   
                </div>
                
                <div> 
                    <select name="layer_id" wire:model="layer_id" wire:change="initMapIndexContent" class="form-control">
                        <option value=''>Seleziona un indice</option>
                        <option value="AGRICULTURE">Superficie coltivata</option>
                        <option value='NDVI'>NDVI</option>
                        <!--<option value='LANDSAT8-NDVI_RGB'>Indice NDVI RGB</option>
                        <option value='LANDSAT8-NDVI-INDICE'>Indice NDVI</option>-->
                        <option value='MOISTURE-INDEX'>Indice di umidità</option>
                    </select>
                </div>
            </div>
            <div class="w-100 text-center">
                <label class="form-label" for="customRange1">Giorno selezionato <br />{{$date_form}}</label>
                <input class="form-range w-100" id="customRange1" type="range" wire:model="minusdays" wire:change="initMapIndexContent" min="-720" max="0" step="10">
            </div>
        </div>
        <style>
            #mapindex {
                height: 500px;
                /* The height is 400 pixels */
                width: 100%;
                /* The width is the width of the web page */
            }
        </style>
        <div wire:init="initMapIndexContent" class="map-index-container">
            <div id="mapindex" class="mb-2"></div>
        </div> 
       
      
        
    </div>


   