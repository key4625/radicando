<div>
    <div class="my-2 row form-inline">
        <div class="col-12 text-center"><h3>Da preparare</h3></div>
        <div class="col-12 col-md-6 text-center text-md-right"><span>dal </span><input type="date" wire:model="filter_data" class="form-control"></div>
        <div class="col-12 col-md-6 text-center text-md-left"> <span>al </span><input type="date" wire:model="filter_data2" class="form-control"></div>
    </div>
    @if(count($plants)>0)
        <h6 class="text-center">Verdure</h6>
        <div id="accordion">
            @foreach($plants as $tmp_plant)  
            <div class="card mb-1">
                <div class="card-header p-2" id="heading-{{$tmp_plant['item_id']}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link  w-100 d-flex justify-content-between" data-toggle="collapse" data-target="#collapse-{{$tmp_plant['item_id']}}" aria-expanded="true" aria-controls="collapse-{{$tmp_plant['item_id']}}">
                            
                            <div >
                                @if($tmp_plant['image'] != null)
                                    <img class="img-responsive" style="max-height:40px;" src="{{$tmp_plant['image']}}" alt="{{$tmp_plant['name']}}">
                                @else 
                                    <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_plant['name']}}">
                                @endif    
                            </div>
                            <div >
                                <label for="nome" class="col-form-label">{{$tmp_plant['name']}}</label>
                            </div>
                            <div >
                                {{$tmp_plant['quantity']}} {{$tmp_plant['quantity_um']}}
                            </div>   
                             
                        </button>
                    </h5>
                </div>
                <div id="collapse-{{$tmp_plant['item_id']}}" class="collapse" aria-labelledby="heading-{{$tmp_plant['item_id']}}" data-parent="#accordion">
                    <div class="card-body p-2">
                        <ul class="list-group bg-white">
                            @foreach($tmp_plant['order_user_list'] as $single_user)
                                <li class="list-group-item">{{ $single_user }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{--<ul class="list-group bg-white"> 
            @foreach($plants as $tmp_plant)           
                <li class="list-group-item">
                    <div class="row g-3 align-items-center">
                        <div class="col">
                            @if($tmp_plant['image'] != null)
                                <img class="img-responsive" style="max-height:40px;" src="{{$tmp_plant['image']}}" alt="{{$tmp_plant['name']}}">
                            @else 
                                <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_plant['name']}}">
                            @endif    
                        </div>
                        <div class="col-auto">
                            <label for="nome" class="col-form-label">{{$tmp_plant['name']}}</label>
                        </div>
                        <div class="col text-right">
                            {{$tmp_plant['quantity']}} {{$tmp_plant['quantity_um']}}
                        </div>   
                        <div>
                            @foreach($tmp_plant['order_user_list'] as $single_user)
                                {{ $single_user }}
                            @endforeach
                        </div>
                    </div>    
                </li>
            @endforeach
        </ul>--}}
    @endif


    @if(count($products)>0)
        <h6 class="text-center mt-3">Prodotti</h6>
        <ul class="list-group bg-white"> 
            @foreach($products as $tmp_prod)           
            <li class="list-group-item">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        @if($tmp_prod['image'] != null)
                            <img class="img-responsive" style="max-height:40px;" src="{{ $tmp_prod['image'] }}" alt="{{$tmp_prod['name']}}">
                        @else 
                            <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$tmp_prod['name']}}">
                        @endif   
                        
                    </div>
                    <div class="col-auto">
                        <label for="nome" class="col-form-label">{{$tmp_prod['name']}}</label>
                    </div>
                    <div class="col  text-right">
                        {{$tmp_prod['quantity']}} {{$tmp_prod['quantity_um']}}
                    </div>     
                </div>    
            </li>
            @endforeach
        </ul>
    @endif
                
</div>
