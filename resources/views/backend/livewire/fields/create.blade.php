<div class="row">
    <div class="col-12 col-md-4">
        <x-backend.card >
            <x-slot name="header">
                <div class="float-left">    
                    <h5 class="modal-title">Nuovo terreno</h5>
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

                    @php 
                        $totPunti = count($points);
                    @endphp
                    
                    @for ($i=0; $i < $totPunti; $i++)
                        <div class="row my-2" id="field-{{$i}}">
                            <div class="col-md-4">
                                <input type="text" name="points[{{ $i }}][key]" class="form-control" value="{{ $points[$i]['key'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <textarea name="points[{{ $i }}][value]" class="form-control">{{ $points[$i]['value'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-2 text-center text-md-left"> 
                                <button type="button" name="remove" id="{{$i}}" class="btn btn-danger btn_remove ">X</button>
                            </div>
                        </div>
                    @endfor
                
                    <div id="dynamic_field">
                        <div class="row my-2 field-{{$totPunti}}" >
                            <div class="col-md-4">
                                <input type="text" name="points[{{$totPunti}}][key]" class="form-control" 
                                    value="{{ $points[$totPunti]['key'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <textarea name="points[{{$totPunti}}][value]" class="form-control">{{ $points[$totPunti]['value'] ?? '' }}</textarea>
                            </div>
                            <div class="col-md-2 text-center text-md-left"> 
                                    <button type="button" name="btndAddPoints" id="btndAddPoints" class="btn btn-success ">+</button>     
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="points">Punti</label>
                        <input type="points" class="form-control" id="points" wire:model="points">
                        @error('points') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                
                            
                    <div class="form-group col-12 text-center text-md-right">
                        <button wire:click.prevent="resetInputFields()" class="btn btn-danger"><i class="far fa-times-circle m-auto d-block"></i> Annulla</button>
                        <button wire:click.prevent="store()" class="btn btn-success"><i class="fas fa-save m-auto d-block"></i> Salva</button>
                    </div>
                
                    
                </form>
            </x-slot>
        </x-backend.card>
    </div>
    <div class="col-12 col-md-8">
        <style>
            #map {
                height: 400px;
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

@push('after-scripts')
    <script type="text/javascript">

        $(document).ready(function(){  
            var i={{$totPunti}};     
            $('#btndAddPoints').click(function(){  
            i++;  
            //$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="name[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>'); 
            $('#dynamic_field').append('<div class="row my-2 dynamic-added" id="field-'+i+'"><div class="col-md-4"><input type="text" name="points['+i+'][key]" class="form-control" value=""></div><div class="col-md-6"><textarea name="points['+i+'][value]" class="form-control"></textarea></div><div class="col-md-2 text-center text-md-left"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></div></div>'); 
            });  
            $(document).on('click', '.btn_remove', function(){  
            var button_id = $(this).attr("id");   
            $('#field-'+button_id+'').remove();  
            });  
        });  
    </script>
@endpush
