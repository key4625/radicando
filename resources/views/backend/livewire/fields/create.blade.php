<div class="row">
    <div class="col-12 mb-2 text-right"><button wire:click.prevent="resetInputFields()" class="btn btn-primary"><i class="fas fa-step-backward"></i> Indietro</button></div>
    <div class="col-12 col-md-4">
        <x-backend.card >
            <x-slot name="header">
                <div class="float-left">    
                    <h5 class="modal-title">Terreno</h5>
                </div>
                <div class="float-right">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="$set('editMode', false)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                </x-slot>   
            <x-slot name="body">  
                <form class="form-row">
                    <div class="form-group col-12">
                        <label for="name">Nome</label>
                        <input type="name" class="form-control" id="name" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group col-12">
                        <label for="location">Località nelle vicinanze</label>
                        <input type="location" class="form-control" id="location" wire:model="location">
                        @error('location') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                   
                    <div class="form-group col-12">
                        <label for="mq">Mq Totali</label>
                        <input type="mq" class="form-control" id="mq" wire:model="mq">
                        @error('mq') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                   
                    <div class="form-group col-12">
                        <hr>
                        <div class="row my-2">
                            <div class="col-6"><label for="point">Lista punti</label></label></div>
                            <div class="col-6 text-right"><button type="button" wire:click="addPoint()" class="btn btn-success btn-sm">+ Aggiungi</button></div>
                        </div> 
                        @if(($points!=null))
                            @foreach ($points as $key => $item)
                                    <div class="row my-1">
                                        @foreach ($item as $key2 => $subitem)
                                            <div class="col">
                                                <input type="text" wire:model="points.{{ $key }}.{{$key2}}" class="form-control form-control-sm">
                                            </div>
                                        @endforeach
                                        <div class="col"> 
                                            <button type="button" name="remove" id="{{$key}}" wire:click="removePoint({{$key}})" class="btn btn-danger btn_remove  btn-sm"><i class="fas fa-trash "></i></button>
                                        </div>
                                    </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-6"><button wire:click.prevent="resetInputFields()" class="btn btn-danger w-100"><i class="far fa-times-circle"></i> Annulla</button></div>
                    <div class="col-6"><button wire:click.prevent="store()" class="btn btn-success w-100"><i class="fas fa-save"></i> Salva</button></div>
                 
                    
                
                    
                </form>
            </x-slot>
        </x-backend.card>
    </div>
    <div class="col-12 col-md-8">
        <style>
            #map {
                height: 600px;
                /* The height is 400 pixels */
                width: 100%;
                /* The width is the width of the web page */
            }
        </style>
        <div wire:init="initMapContent" wire:ignore class="map-container">
            <div id="map" class="mb-2"></div>
        </div> 
    </div>
</div>


