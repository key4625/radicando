<div>
    {{--@if($editMode)--}}
       
            @if($operationtype_id==null)
                <h3 class="mb-3 text-center">Seleziona tipo operazione</h3>
                <div class="row">
                    @foreach($operationtypes as $otype)
                        @if($otype->id != 9)
                        <div class="col-4 col-md-2">
                            <div class="card" wire:click="setOtype({{$otype->id}})">
                                <img class="card-img-top p-4" src="/img/operazioni/{{$otype->icon}}" alt="{{$otype->name}}">
                                <div class="card-body">
                                    <h5 class="card-title text-center">{{$otype->name}}</h5>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                        @else 
                        <div class="col-12">
                            <div class="card" wire:click="setOtype({{$otype->id}})">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div><img class="d-inline m-2" style="height:50px;" src="/img/operazioni/{{$otype->icon}}" alt="{{$otype->name}}"></div>
                                    <div><h5 class="d-inline card-title text-center">{{$otype->name}}</h5></div>
                                    <a href="#" class="stretched-link"></a>
                                </div>
                               
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else 
                <div class="w-100 text-right">
                    <button type="button" class="btn btn-primary mb-2" aria-label="Close" wire:click="toggleEdit">Indietro</button>
                </div>
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
                                    <option value={{ $cultiv_tmp->id }}>{{ $cultiv_tmp->cultivable->nome }}</option>
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
    {{--@else--}}
        <h3 class="my-3 text-center">Elenco operazioni effettuate</h3>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Elenco operazioni effettuate</div>
                    <div class="d-flex align-items-center">                   
                    </div>
                    <div></div>
                </div>
            </div>
            <div class="card-body"> 
                @if($actual_operations!=null)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    @foreach($actual_operations as $single_op)
                                        <tr >
                                            <td>@if($single_op->operationtype->icon != null)<img class="img-fluid" style="height:50px;" src="/img/operazioni/{{ $single_op->operationtype->icon }}">@else <img class="img-fluid" style="height:50px;" src="/img/operazioni/operazioni.png">@endif</td>
                                            <td>{{ $single_op->operationtype->name }}</td>
                                            <td>
                                                @if($single_op->field!=null){{ $single_op->field->name }}@endif
                                                @if($single_op->cultivation!=null){{ $single_op->cultivation->cultivable->name }}@endif
                                            </td>
                                            <td>@if($single_op->date_start!=null){{ Carbon\Carbon::parse($single_op->date_start )->format('d M Y')}}@else non prevista @endif</td>
                                            <td>{{ $single_op->name }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-dark" wire:click="setOperation({{$single_op->id}})">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger" wire:click="$emit('deleteTriggered',{{$single_op->id}},'{{$single_op->operationtype->name}}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            {{ $actual_operations->links() }}
                        @endif 
            </div>
        </div>
    {{--@endif--}}
</div>
