
    <div class="clearfix">
        <button wire:click="$set('showMode', false)" class="float-right btn btn-primary">Indietro</button>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 my-4">
            <h3>Ordine attuale</h3>
            <div class="row my-2">
                <div class="col-12 col-md-3 text-center text-md-left">
                    <label for="nome" class="col-form-label">Nome</label>
                    <input type="text" class="form-control" wire:model="nome" required>
                    @error('nome') <span class="error text-danger">Devi inserire un nome</span> @enderror
                </div>
                <div class="col-6 col-md-3 text-center text-md-left">
                    <label for="nome" class="col-form-label">Data</label>
                    <input type="date" class="form-control" wire:model="data" required>
                </div>
                <div class="col-6 col-md-3 text-center text-md-left">
                    <label for="nome" class="col-form-label">Ora</label>
                    <input type="time" class="form-control" wire:model="ora" required>
                </div>
              
                <div class="col-12 col-md-3  text-center text-md-left">
                    <label for="tipo_cliente" class="col-form-label">Tipo</label>
                    <select class="form-control" wire:model="tipo_cliente" wire:change="ricalcolaPrezzo">
                        <option value="privato">Privato</option>
                        <option value="rivenditore">Rivenditore</option>
                        <option value="gas">Gas</option>
                        <option value="dipendente">Dipendente</option>
                    </select>
                    @error('tel') <span class="error text-danger">Telefono non valido</span> @enderror
                </div>
            </div>
            @if($sel_order->plants->count() > 0)
               
                <ul class="list-group"> 
                    @foreach($sel_order->plants()->withPivot('quantity_kg','quantity_num','price_kg')->get() as $plant_ord)
                        <li class="list-group-item">
                            <div class="row g-3 align-items-center">
                                <div class="col-4">
                                    @if($plant_ord->image != null)
                                        <img class="img-responsive" style="max-height:40px;" src="{{$plant_ord->image}}" alt="{{$plant_ord->nome}}">
                                    @else 
                                        <img class="img-responsive" style="max-height:40px;" src="/img/img-placeholder.png" alt="{{$plant_ord->nome}}">
                                    @endif   
                                    <label for="nome" class="col-form-label">{{$plant_ord->nome}} </label>
                                    @if($plant_ord->prezzo_kg!=0)<label for="prezzo" class="col-form-label float-right">{{$plant_ord->pivot->price_kg}} € </label>@endif
                                </div>
                                <div class="col-3 ">
                                    <div class="input-group">
                                        <input class="form-control quantity_kg" type="number" wire:model="quantity_kg.{{$plant_ord->id}}" wire:change="ricalcolaPrezzo" default="0">
                                        <div class="input-group-append"><span class="input-group-text">Kg</span></div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        {{--<label for="num" class="col-form-label mx-2">Quanti pezzi?</label>--}}
                                        <input class="form-control d-inline" type="number" wire:model="quantity_num.{{$plant_ord->id}}" wire:change="ricalcolaPrezzo" default="0">
                                        <div class="input-group-append"><span class="input-group-text">Pz</span></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger-outline" wire:click="remove({{$plant_ord->id}})"><i class="fas fa-trash"></i></button>
                                </div>       
                            </div>    
                        </li>
                    @endforeach
                </ul>
                <div class="form-group row my-3">                  
                    <label for="price_order" class="col-sm-4 col-form-label">Importo totale consigliato: {{$prezzo_tot_consigliato}}€ 
                        @if($sconto_perc > 0)<br> Con sconto {{$sconto_perc}}%: {{$prezzo_tot_consigliato_scontato}}€ @endif</label>
                    <label for="price_order" class="col col-form-label text-right">TOTALE</label>
                    <div class="col">   
                        <div class="input-group">
                            <input type="text" class="form-control" wire:model="prezzo_tot" >
                            <div class="input-group-append">
                                <span class="input-group-text" >€</span>
                            </div>
                        </div>
                    </div>
                    @error('prezzo_tot') <span class="error text-danger">Prezzo non valido</span> @enderror
                   
                </div>
                <div class="row">
                    <div class="col-12 col-md-6  text-center text-md-left">
                        <label for="email" class="col-form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" wire:model="email" >
                        @error('email') <span class="error text-danger">Devi inserire una email valida</span> @enderror
                    </div>
                    <div class="col-12 col-md-6  text-center text-md-left">
                        <label for="tel" class="col-form-label">Tel</label>
                        <input type="text" class="form-control form-control-sm" wire:model="tel">
                        @error('tel') <span class="error text-danger">Telefono non valido</span> @enderror
                    </div>
                </div>
                <div class="mt-4 text-center">
                  
                    <button wire:click="ordina(1)" class="btn btn-primary">Salva</button>
                    <button wire:click="ordina(2)" class="btn btn-primary">Salva e Nuovo</button>
                    <button wire:click="ordina(3)" class="btn btn-primary">Salva e Rimani</button>
                </div>
            @endif  
        </div>
        <div class="col-12 col-md-6 my-4 order-md-first">
            <h3 class="mb-4">Elenco ortaggi disponibili</h3>
            <div class="row card-group">
                @foreach(App\Models\Plant::whereNotIn('id', $sel_order->plants->pluck('id'))->where('vendibile',1)->get() as $plant)
                    <div class=" col-6 col-md-4">
                        <div class="card mb-4" wire:click="add({{$plant->id}})">
                            <div class="card-body text-center">
                                <div class="d-flex align-items-center" style="min-height: 130px;">
                                    @if($plant->image != null)
                                        <img class="img-fluid" src="{{$plant->image}}" alt="{{$plant->nome}}">
                                    @else 
                                        <img class="img-fluid" src="/img/img-placeholder.png" alt="{{$plant->nome}}">
                                    @endif    
                                </div>
                                {{$plant->nome}} @if($plant->prezzo_kg!=null)<br />{{$plant->prezzo_kg}}€/kg @endif
                            </div>
                        </div>
                    
                    </div>
                @endforeach
            </div>
        </div>
       
    </div>
    
 
