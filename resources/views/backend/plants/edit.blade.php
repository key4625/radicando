@extends('backend.layouts.app')

@push('after-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @if(isset($plant)) Modifica coltura @else Crea nuova coltura @endif
            <x-slot name="headerActions">
                <a href="{{route('admin.piante.index')}}" class="btn btn-primary"><i class="fas fa-home"></i> Indice</a> 
            </x-slot>
        </x-slot>

        <x-slot name="body">
            {{--@if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> 
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li></li>
                        @endforeach
                    </ul>
                </div>
            @endif--}}
            @if(isset($plant))
                <form action="{{ route('admin.piante.update',$plant->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            @else
                <form action="{{ route('admin.piante.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
            @endif
                
              
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" @if(isset($plant)) value="{{$plant->nome}}" @endif class="form-control" placeholder="Nome">
                        </div>
                    </div> 
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Abbreviazione</label>
                            <input type="text" name="abbreviazione" @if(isset($plant)) value="{{$plant->abbreviazione}}" @endif class="form-control" placeholder="Abbreviazione">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Fragilità</label>
                           <select class="form-control" name="fragile">
                               <option value="0" @if(isset($plant)&&($plant->fragile==0)) selected="selected" @endif>0</option>
                               <option value="1" @if(isset($plant)&&($plant->fragile==1)) selected="selected" @endif>1</option>
                               <option value="2" @if(isset($plant)&&($plant->fragile==2)) selected="selected" @endif>2</option>
                               <option value="3" @if(isset($plant)&&($plant->fragile==3)) selected="selected" @endif>3</option>
                               <option value="4" @if(isset($plant)&&($plant->fragile==4)) selected="selected" @endif>4</option>
                               <option value="5" @if(isset($plant)&&($plant->fragile==5)) selected="selected" @endif>5</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Vendibile</label>
                           <select class="form-control" name="vendibile">
                               <option value="1" @if(isset($plant)&&($plant->vendibile==1)) selected="selected" @endif>Si</option>
                               <option value="0" @if(isset($plant)&&($plant->vendibile==0)) selected="selected" @endif>No</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Tipologia</label>
                           <select class="form-control" name="plantcategories_id">
                                @foreach($plant_categories as $key => $value)             
                                    <option value="{{$key}}" @if(isset($plant)&&($plant->plantcategories_id==$key)) selected="selected" @endif>{{$value}}</option>       
                                @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Prezzo</label>
                            <input type="text" name="price" @if(isset($plant)) value="{{$plant->price}}" @endif class="form-control" placeholder="0,0">
                            @error('price')<div class="text-danger">Inserire un prezzo</div>@enderror
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label>U.M. per il prezzo</label>
                            <input type="text" name="price_um" @if(isset($plant)) value="{{$plant->price_um}}" @else value="kg" @endif class="form-control" placeholder="kg">
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="form-group">
                            <label>U.M. per la selezione</label>
                            <input type="text" name="quantity_um" @if(isset($plant)) value="{{$plant->quantity_um}}" @else value="kg"  @endif class="form-control" placeholder="kg,pz..">
                        </div>
                    </div>
                    {{--<div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Url immagine</label>
                            <input type="text" name="image" @if(isset($plant)) value="{{$plant->image}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>--}}
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Immagine</label>
                            <input type="file" class="form-control-file" name="file_upload">
                        </div>
                        <div class="form-group">
                            @if(isset($plant)&&($plant->image!=null)) 
                            <img class="img-fluid" style="max-height:200px;" src="{{ $plant->getImage() }}">
                            @endif
                        </div>
                    </div>
                   
                 
                </div>
                    @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")
                        <hr>
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label>Sulla fila (cm)</label>
                                    <input type="number" name="sulla_fila" @if(isset($plant)) value="{{$plant->sulla_fila}}" @endif class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label>Tra le file (cm)</label>
                                    <input type="number" name="tra_file" @if(isset($plant)) value="{{$plant->tra_file}}" @endif class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="form-group">
                                    <label>Resa pianta/kg</label>
                                    <input type="text" name="resa_pianta_kg" @if(isset($plant)) value="{{$plant->resa_pianta_kg}}" @endif class="form-control" placeholder="0.0">
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Trapianto</label>
                                    @php 
                                        $plant_trapianto = json_decode(str_replace('"','',$plant->trapianto)); 
                                        $plant_semina = json_decode(str_replace('"','',$plant->semina)); 
                                        $plant_semina_out = json_decode(str_replace('"','',$plant->semina_out)); 
                                        $plant_raccolta = json_decode(str_replace('"','',$plant->raccolta)); 
                                        $plant_gg_campo = json_decode(str_replace('"','',$plant->gg_campo)); 
                                        //dd($plant_trapianto);
                                    @endphp
                                    <select id="sel_trapianto" class="form-control" name="trapianto[]" multiple="">
                                        
                                        <option value="1" @if(($plant_trapianto!=null)&&(in_array(1, $plant_trapianto))) selected @endif >Gennaio</option>
                                        <option value="2" @if(($plant_trapianto!=null)&&(in_array(2, $plant_trapianto))) selected @endif>Febbraio</option>
                                        <option value="3" @if(($plant_trapianto!=null)&&(in_array(3, $plant_trapianto))) selected @endif>Marzo</option>
                                        <option value="4" @if(($plant_trapianto!=null)&&(in_array(4, $plant_trapianto))) selected @endif>Aprile</option>
                                        <option value="5" @if(($plant_trapianto!=null)&&(in_array(5, $plant_trapianto))) selected @endif>Maggio</option>
                                        <option value="6" @if(($plant_trapianto!=null)&&(in_array(6, $plant_trapianto))) selected @endif>Giugno</option>
                                        <option value="7" @if(($plant_trapianto!=null)&&(in_array(7, $plant_trapianto))) selected @endif>Luglio</option>
                                        <option value="8" @if(($plant_trapianto!=null)&&(in_array(8, $plant_trapianto))) selected @endif>Agosto</option>
                                        <option value="9" @if(($plant_trapianto!=null)&&(in_array(9, $plant_trapianto))) selected @endif>Settembre</option>
                                        <option value="10" @if(($plant_trapianto!=null)&&(in_array(10, $plant_trapianto))) selected @endif>Ottobre</option>
                                        <option value="11" @if(($plant_trapianto!=null)&&(in_array(11, $plant_trapianto))) selected @endif>Novembre</option>
                                        <option value="12" @if(($plant_trapianto!=null)&&(in_array(12, $plant_trapianto))) selected @endif>Dicembre</option>
                                    </select>                        
                                    {{--<input type="text" name="trapianto" @if(isset($plant)) value="{{$plant->trapianto}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Semina</label>
                                    <select id="sel_semina" class="form-control" name="semina[]" multiple="">
                                        <option value="1" @if(($plant_semina!=null)&&(in_array(1, $plant_semina))) selected @endif >Gennaio</option>
                                        <option value="2" @if(($plant_semina!=null)&&(in_array(2, $plant_semina))) selected @endif>Febbraio</option>
                                        <option value="3" @if(($plant_semina!=null)&&(in_array(3, $plant_semina))) selected @endif>Marzo</option>
                                        <option value="4" @if(($plant_semina!=null)&&(in_array(4, $plant_semina))) selected @endif>Aprile</option>
                                        <option value="5" @if(($plant_semina!=null)&&(in_array(5, $plant_semina))) selected @endif>Maggio</option>
                                        <option value="6" @if(($plant_semina!=null)&&(in_array(6, $plant_semina))) selected @endif>Giugno</option>
                                        <option value="7" @if(($plant_semina!=null)&&(in_array(7, $plant_semina))) selected @endif>Luglio</option>
                                        <option value="8" @if(($plant_semina!=null)&&(in_array(8, $plant_semina))) selected @endif>Agosto</option>
                                        <option value="9" @if(($plant_semina!=null)&&(in_array(9, $plant_semina))) selected @endif>Settembre</option>
                                        <option value="10" @if(($plant_semina!=null)&&(in_array(10, $plant_semina))) selected @endif>Ottobre</option>
                                        <option value="11" @if(($plant_semina!=null)&&(in_array(11, $plant_semina))) selected @endif>Novembre</option>
                                        <option value="12" @if(($plant_semina!=null)&&(in_array(12, $plant_semina))) selected @endif>Dicembre</option>
                                    </select>
                                    {{--<input type="text" name="semina" @if(($plant_semina!=null)&&(isset($plant)) value="{{$plant->semina}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Semina aperto</label>
                                    <select id="sel_semina_out" class="form-control" name="semina_out[]" multiple="">
                                        <option value="1" @if(($plant_semina_out!=null)&&(in_array(1, $plant_semina_out))) selected @endif >Gennaio</option>
                                        <option value="2" @if(($plant_semina_out!=null)&&(in_array(2, $plant_semina_out))) selected @endif>Febbraio</option>
                                        <option value="3" @if(($plant_semina_out!=null)&&(in_array(3, $plant_semina_out))) selected @endif>Marzo</option>
                                        <option value="4" @if(($plant_semina_out!=null)&&(in_array(4, $plant_semina_out))) selected @endif>Aprile</option>
                                        <option value="5" @if(($plant_semina_out!=null)&&(in_array(5, $plant_semina_out))) selected @endif>Maggio</option>
                                        <option value="6" @if(($plant_semina_out!=null)&&(in_array(6, $plant_semina_out))) selected @endif>Giugno</option>
                                        <option value="7" @if(($plant_semina_out!=null)&&(in_array(7, $plant_semina_out))) selected @endif>Luglio</option>
                                        <option value="8" @if(($plant_semina_out!=null)&&(in_array(8, $plant_semina_out))) selected @endif>Agosto</option>
                                        <option value="9" @if(($plant_semina_out!=null)&&(in_array(9, $plant_semina_out))) selected @endif>Settembre</option>
                                        <option value="10" @if(($plant_semina_out!=null)&&(in_array(10, $plant_semina_out))) selected @endif>Ottobre</option>
                                        <option value="11" @if(($plant_semina_out!=null)&&(in_array(11, $plant_semina_out))) selected @endif>Novembre</option>
                                        <option value="12" @if(($plant_semina_out!=null)&&(in_array(12, $plant_semina_out))) selected @endif>Dicembre</option>
                                    </select>
                                    {{--<input type="text" name="semina_out" @if(($plant_semina!=null)&&(isset($plant))) value="{{$plant->semina_out}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-group">
                                    <label>Raccolta</label>
                                    <select id="sel_raccolta" class="form-control" name="raccolta[]" multiple="">
                                        <option value="1" @if(($plant_raccolta!=null)&&(in_array(1, $plant_raccolta))) selected @endif >Gennaio</option>
                                        <option value="2" @if(($plant_raccolta!=null)&&(in_array(2, $plant_raccolta))) selected @endif>Febbraio</option>
                                        <option value="3" @if(($plant_raccolta!=null)&&(in_array(3, $plant_raccolta))) selected @endif>Marzo</option>
                                        <option value="4" @if(($plant_raccolta!=null)&&(in_array(4, $plant_raccolta))) selected @endif>Aprile</option>
                                        <option value="5" @if(($plant_raccolta!=null)&&(in_array(5, $plant_raccolta))) selected @endif>Maggio</option>
                                        <option value="6" @if(($plant_raccolta!=null)&&(in_array(6, $plant_raccolta))) selected @endif>Giugno</option>
                                        <option value="7" @if(($plant_raccolta!=null)&&(in_array(7, $plant_raccolta))) selected @endif>Luglio</option>
                                        <option value="8" @if(($plant_raccolta!=null)&&(in_array(8, $plant_raccolta))) selected @endif>Agosto</option>
                                        <option value="9" @if(($plant_raccolta!=null)&&(in_array(9, $plant_raccolta))) selected @endif>Settembre</option>
                                        <option value="10" @if(($plant_raccolta!=null)&&(in_array(10, $plant_raccolta))) selected @endif>Ottobre</option>
                                        <option value="11" @if(($plant_raccolta!=null)&&(in_array(11, $plant_raccolta))) selected @endif>Novembre</option>
                                        <option value="12" @if(($plant_raccolta!=null)&&(in_array(12, $plant_raccolta))) selected @endif>Dicembre</option>
                                    </select>
                                    {{--<input type="text" name="raccolta" @if(isset($plant)) value="{{$plant->raccolta}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Giorni in campo (gg)</label>
                                    <select id="sel_gg_campo" class="form-control" name="gg_campo[]" multiple="">
                                        <option value="15" @if(($plant_gg_campo!=null)&&(in_array(15, $plant_gg_campo))) selected @endif >15</option>
                                        <option value="30" @if(($plant_gg_campo!=null)&&(in_array(30, $plant_gg_campo))) selected @endif >30</option>
                                        <option value="40" @if(($plant_gg_campo!=null)&&(in_array(40, $plant_gg_campo))) selected @endif >40</option>
                                        <option value="50" @if(($plant_gg_campo!=null)&&(in_array(50, $plant_gg_campo))) selected @endif >50</option>
                                        <option value="60" @if(($plant_gg_campo!=null)&&(in_array(60, $plant_gg_campo))) selected @endif>60</option>
                                        <option value="70" @if(($plant_gg_campo!=null)&&(in_array(70, $plant_gg_campo))) selected @endif>70</option>
                                        <option value="80" @if(($plant_gg_campo!=null)&&(in_array(80, $plant_gg_campo))) selected @endif>80</option>
                                        <option value="90" @if(($plant_gg_campo!=null)&&(in_array(90, $plant_gg_campo))) selected @endif>90</option>
                                        <option value="100" @if(($plant_gg_campo!=null)&&(in_array(100, $plant_gg_campo))) selected @endif>100</option>
                                        <option value="110" @if(($plant_gg_campo!=null)&&(in_array(110, $plant_gg_campo))) selected @endif>110</option>
                                        <option value="120" @if(($plant_gg_campo!=null)&&(in_array(120, $plant_gg_campo))) selected @endif>120</option>
                                        <option value="150" @if(($plant_gg_campo!=null)&&(in_array(150, $plant_gg_campo))) selected @endif>150</option>
                                        <option value="180" @if(($plant_gg_campo!=null)&&(in_array(180, $plant_gg_campo))) selected @endif>180</option>
                                        <option value="210" @if(($plant_gg_campo!=null)&&(in_array(210, $plant_gg_campo))) selected @endif>210</option>
                                        <option value="240" @if(($plant_gg_campo!=null)&&(in_array(240, $plant_gg_campo))) selected @endif>240</option>
                                        <option value="270" @if(($plant_gg_campo!=null)&&(in_array(270, $plant_gg_campo))) selected @endif>270</option>
                                        <option value="300" @if(($plant_gg_campo!=null)&&(in_array(300, $plant_gg_campo))) selected @endif>300</option>
                                        <option value="330" @if(($plant_gg_campo!=null)&&(in_array(330, $plant_gg_campo))) selected @endif>330</option>
                                        <option value="360" @if(($plant_gg_campo!=null)&&(in_array(360, $plant_gg_campo))) selected @endif>360</option>
                                    </select>
                                    {{--<input type="text" name="gg_campo" @if(isset($plant)) value="{{$plant->gg_campo}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Consumatore</label>
                                    <select class="form-control" name="consumatore">
                                        <option>Forte</option>
                                        <option>Medio</option>
                                        <option>Debole</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label>Stagione</label>
                                    <select class="form-control" name="stagione">
                                        <option>Inverno</option>
                                        <option>Primavera</option>
                                        <option>Estate</option>
                                        <option>Autunno</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Trattamenti consigliati</label>
                                    <input type="text" name="trattamenti_consigliati" @if(isset($plant)) value="{{$plant->trattamenti_consigliati}}" @endif class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label>Richieste nutrizionali</label>
                                    <input type="text" name="richieste_nutrizionali" @if(isset($plant)) value="{{$plant->richieste_nutrizionali}}" @endif class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                    @endif
                  

                    
           
                <div class="row">
                    @if(App\Models\Setting::find('gest_coltivazioni')->value == "on")  
                        <div class="col-12 col-md-4">
                            <div class="form-group">
                                <label>Url marcatore</label>
                                <input type="text" name="icon" @if(isset($plant)) value="{{$plant->icon}}" @endif class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="colorInput" class="form-label">Colore</label>
                            <input id="colorInput"  type="color" name="color" @if(isset($plant)) value="{{$plant->color}}" @endif class="form-control form-control-color" title="Scegli colore">
                        </div>
                        <div class="col-12 col-md-2">
                            <label for="borderColInput" class="form-label">Bordo</label>
                            <input id="borderColInput"  type="color" name="border_color" @if(isset($plant)) value="{{$plant->border_color}}" @endif class="form-control form-control-color" title="Scegli colore">                      
                        </div>
                    @endif
                    <div class="col-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">@if(isset($plant)) <i class="fas fa-save"></i> Salva @else <i class="fas fa-plus"></i> Crea @endif</button>
                    </div>
                </div>
           
        
            </form>

        </x-slot>
    </x-backend.card>

@endsection

@push('after-scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sel_trapianto').select2({
            placeholder: "Sel. mesi",
            allowClear: true,
        });
        $('#sel_semina').select2({
            placeholder: "Sel. mesi",
            allowClear: true,
        });
        $('#sel_semina_out').select2({
            placeholder: "Sel. mesi",
            allowClear: true,
        });
        $('#sel_raccolta').select2({
            placeholder: "Sel. mesi",
            allowClear: true,
        });
        $('#sel_gg_campo').select2({
            placeholder: "Sel. gg",
            allowClear: true,
        });
    });
</script>
@endpush