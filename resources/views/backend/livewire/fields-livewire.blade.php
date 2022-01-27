@if($editMode)    
    @include('backend.livewire.fields.create')
@endif
@if(!$editMode)
    <div class="card">
        <div class="card-body">
        
                <button class="btn btn-success mb-3 text-right" wire:click="toggleInsert()"><i class="fas fa-plus"></i> Nuovo terreno </button>
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

   