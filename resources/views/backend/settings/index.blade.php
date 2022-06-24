@extends('backend.layouts.app')
@push('after-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.0/sweetalert.css">
@endpush
@section('title', appName() . ' | Impostazioni')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif 


<form action="/admin/settings/update" method="POST" enctype="multipart/form-data" class="form"> 
    @csrf    
    <ul class="nav nav-tabs auto">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true" href="#">Generali</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3" aria-selected="true" href="#">Attività</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab4" role="tab" aria-controls="tab4" aria-selected="true" href="#">Ordini</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="true" href="#">Notifiche</a></li>
     
    </ul> 
    <div class="tab-content" id="settingstab">  
        <div class="tab-pane p-4 fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">        
            <div class="row">
                <div class="col-12">         
                    <div class="form-group">
                        <label for="app_company_name">Nome azienda</label>
                        <input type="text" id="app_company_name"class="form-control" name="app_company_name" value="{{$settings['app_company_name']}}">   
                    </div>
                </div>
                <div class="col-12 col-md-4 ">         
                    <div class="form-group">
                        <label for="app_logo">Immagine copertina</label>
                        <div>
                            <input type="file" id="app_logo"class="form-control-file" name="app_logo" value="{{$settings['app_logo']}}">
                        </div>
                        @if($settings['app_logo']!=null) <img style="max-height:250px;" class="mt-4" src="{{ Storage::url($settings['app_logo'])}}"> @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">         
                    <div class="form-group">
                        <label for="app_img_copertina">Immagine copertina</label>
                        <div>
                            <input type="file" id="app_img_copertina"class="form-control-file" name="app_img_copertina" value="{{$settings['app_img_copertina']}}">
                        </div>
                        @if($settings['app_img_copertina']!=null) <img style="max-height:250px;" class="mt-4" src="{{ Storage::url($settings['app_img_copertina'])}}"> @endif
                    </div>
                </div>
                <div class="col-12 col-md-4">         
                    <div class="form-group">
                        <label for="app_img">Immagine generale</label>
                        <div>
                            <input type="file" id="app_img"class="form-control-file" name="app_img" value="{{$settings['app_img']}}">
                        </div>
                        @if($settings['app_img']!=null) <img style="max-height:250px;" class="mt-4" src="{{ Storage::url($settings['app_img'])}}"> @endif
                    </div>
                </div>
                <div class="col-sm-12">    
                    <div class="form-group">
                        <label for="app_descrizione">Descrizione breve</label>
                        <div>
                            <textarea id="app_descrizione_breve" rows="2" class="form-control" name="app_descrizione_breve">{{$settings['app_descrizione_breve']}}</textarea>
                        </div>
                        
                    </div>
                </div>   
                <div class="col-sm-12">    
                    <div class="form-group">
                        <label for="app_descrizione">Descrizione generale</label>
                        <div>
                            <textarea id="app_descrizione" rows="4" class="form-control" name="app_descrizione">{{$settings['app_descrizione']}}</textarea>
                        </div>
                        
                    </div>
                </div>  
                
            </div>  
        </div>
        <div class="tab-pane p-4 fade" id="tab3" role="tabpanel" aria-labelledby="tab3-tab">
            <div class="row">
                <div class="col-6">         
                    <h5 class="mb-3">Settore di attività</h5>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='att_coltivazione'>
                        <input type="checkbox" class="form-check-input" id="att_coltivazione" name="att_coltivazione" @if($settings['att_coltivazione']=="on") checked @endif>
                        <label class="form-check-label" for="att_coltivazione">Coltivazione</label>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <input type='hidden' value='off' name='att_allevamento'>
                        <input type="checkbox" class="form-check-input" id="att_allevamento" name="att_allevamento" @if($settings['att_allevamento']=="on") checked @endif>
                        <label class="form-check-label" for="att_allevamento">Allevamento</label>
                    </div>
                </div>
                <div class="col-6">         
                    <h5 class="mb-3">Tipo di coltivazioni</h5>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='att_seminativo'>
                        <input type="checkbox" class="form-check-input" id="att_seminativo" name="att_seminativo" @if($settings['att_seminativo']=="on") checked @endif>
                        <label class="form-check-label" for="att_seminativo">Seminativo</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='att_orto'>
                        <input type="checkbox" class="form-check-input" id="att_orto" name="att_orto" @if($settings['att_orto']=="on") checked @endif>
                        <label class="form-check-label" for="att_orto" >Orto</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='att_frutteto'>
                        <input type="checkbox" class="form-check-input" id="att_frutteto" name="att_frutteto" @if($settings['att_frutteto']=="on") checked @endif>
                        <label class="form-check-label" for="att_frutteto">Frutteto</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='att_officinali'>
                        <input type="checkbox" class="form-check-input" id="att_officinali" name="att_officinali" @if($settings['att_officinali']=="on") checked @endif>
                        <label class="form-check-label" for="att_officinali">Piante officinali</label>
                    </div>
                  
                </div>
                <div class="col-6">         
                    <h5 class="mb-3">Che cosa vorresti gestire?</h5>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='gest_terreni'>
                        <input type="checkbox" class="form-check-input" id="gest_terreni" name="gest_terreni" @if($settings['gest_terreni']=="on") checked @endif>
                        <label class="form-check-label" for="gest_terreni">Terreni</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='gest_coltivazioni'>
                        <input type="checkbox" class="form-check-input" id="gest_coltivazioni" name="gest_coltivazioni" @if($settings['gest_coltivazioni']=="on") checked @endif>
                        <label class="form-check-label" for="gest_coltivazioni">Coltivazioni</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='gest_raccolto'>
                        <input type="checkbox" class="form-check-input" id="gest_raccolto" name="gest_raccolto" @if($settings['gest_raccolto']=="on") checked @endif>
                        <label class="form-check-label" for="gest_raccolto">Raccolto</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='gest_magazzino'>
                        <input type="checkbox" class="form-check-input" id="gest_magazzino" name="gest_magazzino" @if($settings['gest_magazzino']=="on") checked @endif>
                        <label class="form-check-label" for="gest_magazzino">Magazzino per i prodotti</label>
                    </div>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='gest_diario'>
                        <input type="checkbox" class="form-check-input" id="gest_diario" name="gest_diario" @if($settings['gest_diario']=="on") checked @endif>
                        <label class="form-check-label" for="gest_diario">Diario delle lavorazioni</label>
                    </div>
                   
                   
                    
                </div>
             
               
            </div>
        </div>
        <div class="tab-pane p-4 fade" id="tab4" role="tabpanel" aria-labelledby="tab4-tab">
          
            <div class="row">
                <div class="col-12">         
                    <h5 class="mb-3">Al pubblico vuoi mostrare</h5>
                    <div class="form-group form-check">
                        <input type='hidden' value='off' name='view_only_order'>
                        <input type="checkbox" class="form-check-input" id="view_only_order" name="view_only_order" @if($settings['view_only_order']=="on") checked @endif>
                        <label class="form-check-label" for="view_only_order">Solo la pagina degli ordini</label>
                    </div>
                </div>
                <div class="col-sm-12">    
                    <h5 class="mb-3">Informazioni Pagina ordini</h5>
                    <div class="form-group">
                        <label for="app_ordini_descrizione">Titolo</label>
                        <div>
                            <input type="text" id="app_ordini_titolo" class="form-control" name="app_ordini_titolo" value="@if(isset($settings['app_ordini_titolo'])){{$settings['app_ordini_titolo']}}@endif">
                        </div>
                    </div>
                </div>   
                <div class="col-sm-12">    
                    <div class="form-group">
                        <label for="app_ordini_sottotitolo">Sottotitolo</label>
                        <div>
                            <input type="text" id="app_ordini_sottotitolo" class="form-control" name="app_ordini_sottotitolo" value="@if(isset($settings['app_ordini_sottotitolo'])){{$settings['app_ordini_sottotitolo']}}@endif">
                        </div>
                    </div>
                </div>   
                <div class="col-sm-12">    
                    <div class="form-group">
                        <label for="app_ordini_descrizione">Descrizione breve</label>
                        <div>
                            <textarea id="app_ordini_descrizione" rows="2" class="form-control" name="app_ordini_descrizione">@if(isset($settings['app_ordini_descrizione'])){{$settings['app_ordini_descrizione']}}@endif</textarea>
                        </div>
                    </div>
                </div>   
              
               
            </div>
        </div>
        <div class="tab-pane p-4 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
          
            <div class="row">
                <div class="col-sm-12">         
                    <div class="form-group row">
                      
                    </div>
                </div>
               
            </div>
        </div>
      
    </div>
    <input type="submit" class="btn btn-primary w-100 my-4" value="Salva tutte le impostazioni">

   
</form>

@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        //set initial state.
       
        $('#gest_terreni').change(function() {
            if(!this.checked) {
                $('#gest_coltivazioni').prop("checked", false);
                $('#gest_raccolto').prop("checked", false);  
            }   
        });
        $('#gest_coltivazioni').change(function() {
            if(!this.checked) {    
                $('#gest_raccolto').prop("checked", false);  
            }   
        });


    });
</script>
@endpush

