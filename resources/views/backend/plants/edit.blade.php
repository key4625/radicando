@extends('backend.layouts.app')

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
            @if(isset($plant))
                <form action="{{ route('admin.piante.update',$plant->id) }}" method="POST">
                @csrf
                @method('PUT')
            @else
                <form action="{{ route('admin.piante.store') }}" method="POST" >
                    @csrf
            @endif
                
              
                <div class="row">
                    <div class="col-12 col-md-8">
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
                            <input type="number" name="sulla_fila" @if(isset($plant)) value="{{$plant->sulla_fila}}" @endif class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Tra le file (cm)</label>
                            <input type="number" name="tra_file" @if(isset($plant)) value="{{$plant->tra_file}}" @endif class="form-control" placeholder="0">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Resa pianta/kg</label>
                            <input type="text" name="resa_pianta_kg" @if(isset($plant)) value="{{$plant->resa_pianta_kg}}" @endif class="form-control" placeholder="0.0">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Prezzo al kg</label>
                            <input type="text" name="prezzo_kg" @if(isset($plant)) value="{{$plant->prezzo_kg}}" @endif class="form-control" placeholder="0.0">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="text-center">Inserire i mesi divisi con la virgola</div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Trapianto</label>
                            <input type="text" name="trapianto" @if(isset($plant)) value="{{$plant->trapianto}}" @endif class="form-control" placeholder="[0,0,0]">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Semina</label>
                            <input type="text" name="semina" @if(isset($plant)) value="{{$plant->semina}}" @endif class="form-control" placeholder="[0,0,0]">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Semina aperto</label>
                            <input type="text" name="semina_out" @if(isset($plant)) value="{{$plant->semina_out}}" @endif class="form-control" placeholder="[0,0,0]">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Raccolta</label>
                            <input type="text" name="raccolta" @if(isset($plant)) value="{{$plant->raccolta}}" @endif class="form-control" placeholder="[0,0,0]">
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label>Giorni in campo (gg)</label>
                            <input type="text" name="raccolta" @if(isset($plant)) value="{{$plant->gg_campo}}" @endif class="form-control" placeholder="[0,0,0]">
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
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Trattamenti consigliati</label>
                            <input type="text" name="trattamenti_consigliati" @if(isset($plant)) value="{{$plant->trattamenti_consigliati}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Richieste nutrizionali</label>
                            <input type="text" name="richieste_nutrizionali" @if(isset($plant)) value="{{$plant->richieste_nutrizionali}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                   
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label>Url immagine</label>
                            <input type="text" name="image" @if(isset($plant)) value="{{$plant->image}}" @endif class="form-control" placeholder="">
                        </div>
                    </div>
                    
                    
                 
                   
                    <div class="col-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">@if(isset($plant)) <i class="fas fa-save"></i> Salva @else <i class="fas fa-plus"></i> Crea @endif</button>
                    </div>
                </div>
        
            </form>

        </x-slot>
    </x-backend.card>

@endsection