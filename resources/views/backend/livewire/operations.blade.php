<div>
    @if($editMode)
        <div class="row">
            @foreach($operationtypes as $otype)
                <div class="col-4 col-xl-2">
                    <div class="card">
                        <img class="card-img-top" src="{{$otype->image}}" alt="{{$otype->name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$otype->name}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
