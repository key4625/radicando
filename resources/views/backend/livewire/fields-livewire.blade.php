@if($editMode)    
    @include('backend.livewire.fields.create')
@endif
@if(!$editMode)
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>Terreni</div>
                <button class="btn btn-success mb-3 text-right" wire:click="toggleInsert()"><i class="fas fa-plus"></i> Nuovo terreno </button>
            </div>
        </div>
        <style>
            #mapindex {
                height: 400px;
                /* The height is 400 pixels */
                width: 100%;
                /* The width is the width of the web page */
            }
        </style>
        <div wire:init="initMapIndexContent" class="map-index-container">
            <div id="mapindex" class="mb-2"></div>
        </div> 
        <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Località</th>
                        <th>Mq tot.</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($fields as $field)
                        <tr>
                            <td>{{ $field->name }}</td>
                            <td>{{ $field->location }}</td>
                            <td>{{ $field->mq }}</td>
                            <td class="text-right" style="max-width:150px;">
                                <a class="btn btn-sm btn-info" href="/admin/terreno?idField={{$field->id}}"><i class="fas fa-eye"></i></a>
                                <button class="btn btn-sm btn-dark" wire:click="toggleUpdate({{$field->id}})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" wire:click="$emit('deleteTriggered',{{$field->id}},'{{$field->name}}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            
                            </td> 
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        {{ $fields->links() }}
                    </div>
                </div>
        </div>
    </div>
@endif

   