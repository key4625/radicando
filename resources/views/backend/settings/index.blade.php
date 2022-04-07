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
        <div class="tab-pane p-4 fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
          
            <div class="row">
                <div class="col-sm-12">         
                    <div class="form-group row">
                      
                    </div>
                </div>
               
            </div>
        </div>
    </div>

    <input type="submit" class="btn btn-primary w-100 mt-4" value="Salva tutte le impostazioni">
</form>

@endsection

