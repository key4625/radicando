<div>
    <div class="text-center my-2">
        <h3>Da preparare</h3>
        <span>dal </span>
        <input type="date" wire:model="filter_data" class="form-control d-inline w-auto">
        <span>al </span>
        <input type="date" wire:model="filter_data2" class="form-control d-inline w-auto">
    </div>
    @if(count($plants)>0)
        <h6 class="text-center">Verdure</h6>
        <ul class="list-group bg-white"> 
            @foreach($plants as $tmp_plant)           
                <li class="list-group-item">
                    <div class="row g-3 align-items-center">
                        <div class="col-4">
                            @if($tmp_plant['image'] != null)
                                <img class="img-responsive" style="max-height:40px;" src="{{$tmp_plant['image']}}" alt="{{$tmp_plant['name']}}">
                            @else 
                                <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_plant['name']}}">
                            @endif    
                        </div>
                        <div class="col-4">
                            <label for="nome" class="col-form-label">{{$tmp_plant['name']}}</label>
                        </div>
                        <div class="col-4 ">
                            {{$tmp_plant['quantity']}} {{$tmp_plant['quantity_um']}}
                        </div>   
                    </div>    
                </li>
            @endforeach
        </ul>
    @endif
    @if(count($products)>0)
        <h6 class="text-center mt-3">Prodotti</h6>
        <ul class="list-group bg-white"> 
            @foreach($products as $tmp_prod)           
            <li class="list-group-item">
                <div class="row g-3 align-items-center">
                    <div class="col-4">
                        @if($tmp_prod['image'] != null)
                            <img class="img-responsive" style="max-height:40px;" src="{{ Storage::url($tmp_prod['image']) }}" alt="{{$tmp_prod['name']}}">
                        @else 
                            <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_prod['name']}}">
                        @endif   
                        
                    </div>
                    <div class="col-4">
                        <label for="nome" class="col-form-label">{{$tmp_prod['name']}}</label>
                    </div>
                    <div class="col-4 ">
                        {{$tmp_prod['quantity']}} {{$tmp_prod['quantity_um']}}
                    </div>     
                </div>    
            </li>
            @endforeach
        </ul>
    @endif
                
</div>
