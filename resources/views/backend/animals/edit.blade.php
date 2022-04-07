@extends('backend.layouts.app')

@push('after-styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('title', __('Dashboard'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @if(isset($animal)) Modifica animale @else Crea nuovo animale @endif
            <x-slot name="headerActions">
                <a href="{{route('admin.animali.index')}}" class="btn btn-primary"><i class="fas fa-home"></i> Indice</a> 
            </x-slot>
        </x-slot>

        <x-slot name="body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong> 
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(isset($animal))
                <form action="{{ route('admin.animali.update',$animal->id) }}" method="POST">
                @csrf
                @method('PUT')
            @else
                <form action="{{ route('admin.animali.store') }}" method="POST" >
                    @csrf
            @endif
                
              
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" @if(isset($animal)) value="{{$animal->nome}}" @endif class="form-control" placeholder="Nome">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Abbreviazione</label>
                            <input type="text" name="abbreviazione" @if(isset($animal)) value="{{$animal->abbreviazione}}" @endif class="form-control" placeholder="Abbreviazione">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="form-group">
                            <label>Vendibile</label>
                           <select class="form-control" name="vendibile">
                               <option value="1">Si</option>
                               <option value="0">No</option>
                           </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Sulla fila (cm)</label>
                            <input type="number" name="sulla_fila" @if(isset($animal)) value="{{$animal->sulla_fila}}" @endif class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Tra le file (cm)</label>
                            <input type="number" name="tra_file" @if(isset($animal)) value="{{$animal->tra_file}}" @endif class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Resa pianta/kg</label>
                            <input type="text" name="resa_pianta_kg" @if(isset($animal)) value="{{$animal->resa_pianta_kg}}" @endif class="form-control" placeholder="0.0">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Prezzo al kg</label>
                            <input type="text" name="prezzo_kg" @if(isset($animal)) value="{{$animal->prezzo_kg}}" @endif class="form-control" placeholder="0.0">
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Trapianto</label>
                            @php 
                                $animal_trapianto = json_decode($animal->trapianto); 
                                $animal_semina = json_decode($animal->semina); 
                                $animal_semina_out = json_decode($animal->semina_out); 
                                $animal_raccolta = json_decode($animal->raccolta); 
                                $animal_gg_campo = json_decode($animal->gg_campo); 
                            @endphp
                            <select id="sel_trapianto" class="form-control" name="trapianto[]" multiple="">
                                <option value="1" @if(($animal_trapianto!=null)&&(in_array(1, $animal_trapianto))) selected @endif >Gennaio</option>
                                <option value="2" @if(($animal_trapianto!=null)&&(in_array(2, $animal_trapianto))) selected @endif>Febbraio</option>
                                <option value="3" @if(($animal_trapianto!=null)&&(in_array(3, $animal_trapianto))) selected @endif>Marzo</option>
                                <option value="4" @if(($animal_trapianto!=null)&&(in_array(4, $animal_trapianto))) selected @endif>Aprile</option>
                                <option value="5" @if(($animal_trapianto!=null)&&(in_array(5, $animal_trapianto))) selected @endif>Maggio</option>
                                <option value="6" @if(($animal_trapianto!=null)&&(in_array(6, $animal_trapianto))) selected @endif>Giugno</option>
                                <option value="7" @if(($animal_trapianto!=null)&&(in_array(7, $animal_trapianto))) selected @endif>Luglio</option>
                                <option value="8" @if(($animal_trapianto!=null)&&(in_array(8, $animal_trapianto))) selected @endif>Agosto</option>
                                <option value="9" @if(($animal_trapianto!=null)&&(in_array(9, $animal_trapianto))) selected @endif>Settembre</option>
                                <option value="10" @if(($animal_trapianto!=null)&&(in_array(10, $animal_trapianto))) selected @endif>Ottobre</option>
                                <option value="11" @if(($animal_trapianto!=null)&&(in_array(11, $animal_trapianto))) selected @endif>Novembre</option>
                                <option value="12" @if(($animal_trapianto!=null)&&(in_array(12, $animal_trapianto))) selected @endif>Dicembre</option>
                            </select>                        
                            {{--<input type="text" name="trapianto" @if(isset($animal)) value="{{$animal->trapianto}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Semina</label>
                            <select id="sel_semina" class="form-control" name="semina[]" multiple="">
                                <option value="1" @if(($animal_semina!=null)&&(in_array(1, $animal_semina))) selected @endif >Gennaio</option>
                                <option value="2" @if(($animal_semina!=null)&&(in_array(2, $animal_semina))) selected @endif>Febbraio</option>
                                <option value="3" @if(($animal_semina!=null)&&(in_array(3, $animal_semina))) selected @endif>Marzo</option>
                                <option value="4" @if(($animal_semina!=null)&&(in_array(4, $animal_semina))) selected @endif>Aprile</option>
                                <option value="5" @if(($animal_semina!=null)&&(in_array(5, $animal_semina))) selected @endif>Maggio</option>
                                <option value="6" @if(($animal_semina!=null)&&(in_array(6, $animal_semina))) selected @endif>Giugno</option>
                                <option value="7" @if(($animal_semina!=null)&&(in_array(7, $animal_semina))) selected @endif>Luglio</option>
                                <option value="8" @if(($animal_semina!=null)&&(in_array(8, $animal_semina))) selected @endif>Agosto</option>
                                <option value="9" @if(($animal_semina!=null)&&(in_array(9, $animal_semina))) selected @endif>Settembre</option>
                                <option value="10" @if(($animal_semina!=null)&&(in_array(10, $animal_semina))) selected @endif>Ottobre</option>
                                <option value="11" @if(($animal_semina!=null)&&(in_array(11, $animal_semina))) selected @endif>Novembre</option>
                                <option value="12" @if(($animal_semina!=null)&&(in_array(12, $animal_semina))) selected @endif>Dicembre</option>
                            </select>
                            {{--<input type="text" name="semina" @if(($animal_semina!=null)&&(isset($animal)) value="{{$animal->semina}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Semina aperto</label>
                            <select id="sel_semina_out" class="form-control" name="semina_out[]" multiple="">
                                <option value="1" @if(($animal_semina_out!=null)&&(in_array(1, $animal_semina_out))) selected @endif >Gennaio</option>
                                <option value="2" @if(($animal_semina_out!=null)&&(in_array(2, $animal_semina_out))) selected @endif>Febbraio</option>
                                <option value="3" @if(($animal_semina_out!=null)&&(in_array(3, $animal_semina_out))) selected @endif>Marzo</option>
                                <option value="4" @if(($animal_semina_out!=null)&&(in_array(4, $animal_semina_out))) selected @endif>Aprile</option>
                                <option value="5" @if(($animal_semina_out!=null)&&(in_array(5, $animal_semina_out))) selected @endif>Maggio</option>
                                <option value="6" @if(($animal_semina_out!=null)&&(in_array(6, $animal_semina_out))) selected @endif>Giugno</option>
                                <option value="7" @if(($animal_semina_out!=null)&&(in_array(7, $animal_semina_out))) selected @endif>Luglio</option>
                                <option value="8" @if(($animal_semina_out!=null)&&(in_array(8, $animal_semina_out))) selected @endif>Agosto</option>
                                <option value="9" @if(($animal_semina_out!=null)&&(in_array(9, $animal_semina_out))) selected @endif>Settembre</option>
                                <option value="10" @if(($animal_semina_out!=null)&&(in_array(10, $animal_semina_out))) selected @endif>Ottobre</option>
                                <option value="11" @if(($animal_semina_out!=null)&&(in_array(11, $animal_semina_out))) selected @endif>Novembre</option>
                                <option value="12" @if(($animal_semina_out!=null)&&(in_array(12, $animal_semina_out))) selected @endif>Dicembre</option>
                            </select>
                            {{--<input type="text" name="semina_out" @if(($animal_semina!=null)&&(isset($animal))) value="{{$animal->semina_out}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Raccolta</label>
                            <select id="sel_raccolta" class="form-control" name="raccolta[]" multiple="">
                                <option value="1" @if(($animal_raccolta!=null)&&(in_array(1, $animal_raccolta))) selected @endif >Gennaio</option>
                                <option value="2" @if(($animal_raccolta!=null)&&(in_array(2, $animal_raccolta))) selected @endif>Febbraio</option>
                                <option value="3" @if(($animal_raccolta!=null)&&(in_array(3, $animal_raccolta))) selected @endif>Marzo</option>
                                <option value="4" @if(($animal_raccolta!=null)&&(in_array(4, $animal_raccolta))) selected @endif>Aprile</option>
                                <option value="5" @if(($animal_raccolta!=null)&&(in_array(5, $animal_raccolta))) selected @endif>Maggio</option>
                                <option value="6" @if(($animal_raccolta!=null)&&(in_array(6, $animal_raccolta))) selected @endif>Giugno</option>
                                <option value="7" @if(($animal_raccolta!=null)&&(in_array(7, $animal_raccolta))) selected @endif>Luglio</option>
                                <option value="8" @if(($animal_raccolta!=null)&&(in_array(8, $animal_raccolta))) selected @endif>Agosto</option>
                                <option value="9" @if(($animal_raccolta!=null)&&(in_array(9, $animal_raccolta))) selected @endif>Settembre</option>
                                <option value="10" @if(($animal_raccolta!=null)&&(in_array(10, $animal_raccolta))) selected @endif>Ottobre</option>
                                <option value="11" @if(($animal_raccolta!=null)&&(in_array(11, $animal_raccolta))) selected @endif>Novembre</option>
                                <option value="12" @if(($animal_raccolta!=null)&&(in_array(12, $animal_raccolta))) selected @endif>Dicembre</option>
                            </select>
                            {{--<input type="text" name="raccolta" @if(isset($animal)) value="{{$animal->raccolta}}" @endif class="form-control" placeholder="[0,0,0]">--}}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Giorni in campo (gg)</label>
                            <select id="sel_gg_campo" class="form-control" name="gg_campo[]" multiple="">
                                <option value="15" @if(($animal_gg_campo!=null)&&(in_array(15, $animal_gg_campo))) selected @endif >15</option>
                                <option value="30" @if(($animal_gg_campo!=null)&&(in_array(30, $animal_gg_campo))) selected @endif >30</option>
                                <option value="40" @if(($animal_gg_campo!=null)&&(in_array(40, $animal_gg_campo))) selected @endif >40</option>
                                <option value="50" @if(($animal_gg_campo!=null)&&(in_array(50, $animal_gg_campo))) selected @endif >50</option>
                                <option value="60" @if(($animal_gg_campo!=null)&&(in_array(60, $animal_gg_campo))) selected @endif>60</option>
                                <option value="70" @if(($animal_gg_campo!=null)&&(in_array(70, $animal_gg_campo))) selected @endif>70</option>
                                <option value="80" @if(($animal_gg_campo!=null)&&(in_array(80, $animal_gg_campo))) selected @endif>80</option>
                                <option value="90" @if(($animal_gg_campo!=null)&&(in_array(90, $animal_gg_campo))) selected @endif>90</option>
                                <option value="100" @if(($animal_gg_campo!=null)&&(in_array(100, $animal_gg_campo))) selected @endif>100</option>
                                <option value="110" @if(($animal_gg_campo!=null)&&(in_array(110, $animal_gg_campo))) selected @endif>110</option>
                                <option value="120" @if(($animal_gg_campo!=null)&&(in_array(120, $animal_gg_campo))) selected @endif>120</option>
                                <option value="150" @if(($animal_gg_campo!=null)&&(in_array(150, $animal_gg_campo))) selected @endif>150</option>
                                <option value="180" @if(($animal_gg_campo!=null)&&(in_array(180, $animal_gg_campo))) selected @endif>180</option>
                                <option value="210" @if(($animal_gg_campo!=null)&&(in_array(210, $animal_gg_campo))) selected @endif>210</option>
                                <option value="240" @if(($animal_gg_campo!=null)&&(in_array(240, $animal_gg_campo))) selected @endif>240</option>
                                <option value="270" @if(($animal_gg_campo!=null)&&(in_array(270, $animal_gg_campo))) selected @endif>270</option>
                                <option value="300" @if(($animal_gg_campo!=null)&&(in_array(300, $animal_gg_campo))) selected @endif>300</option>
                                <option value="330" @if(($animal_gg_campo!=null)&&(in_array(330, $animal_gg_campo))) selected @endif>330</option>
                                <option value="360" @if(($animal_gg_campo!=null)&&(in_array(360, $animal_gg_campo))) selected @endif>360</option>
                            </select>
                            {{--<input type="text" name="gg_campo" @if(isset($animal)) value="{{$animal->gg_campo}}" @endif class="form-control" placeholder="[0,0,0]">--}}
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
                            <input type="text" name="trattamenti_consigliati" @if(isset($animal)) value="{{$animal->trattamenti_consigliati}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Richieste nutrizionali</label>
                            <input type="text" name="richieste_nutrizionali" @if(isset($animal)) value="{{$animal->richieste_nutrizionali}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                   
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Url immagine</label>
                            <input type="text" name="image" @if(isset($animal)) value="{{$animal->image}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Url marcatore</label>
                            <input type="text" name="icon" @if(isset($animal)) value="{{$animal->icon}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="colorInput" class="form-label">Colore</label>
                        <input id="colorInput"  type="color" name="color" @if(isset($animal)) value="{{$animal->color}}" @endif class="form-control form-control-color" title="Scegli colore">
                    </div>
                    <div class="col-12 col-md-2">
                        <label for="borderColInput" class="form-label">Bordo</label>
                        <input id="borderColInput"  type="color" name="border_color" @if(isset($animal)) value="{{$animal->border_color}}" @endif class="form-control form-control-color" title="Scegli colore">
                        
                    </div>
                    
                    
                 
                   
                    <div class="col-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">@if(isset($animal)) <i class="fas fa-save"></i> Salva @else <i class="fas fa-plus"></i> Crea @endif</button>
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