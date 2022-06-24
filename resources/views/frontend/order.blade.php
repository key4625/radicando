@extends('frontend.layouts.app-index')

@section('Ordina', __('Ordina'))

@section('content')
    <div class="d-none d-md-block new-app-main-banner-area ordina-main-banner-area" style="background-image:url('{{ Storage::url(App\Models\Setting::find('app_img_copertina')->value)}}');">
        {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
        <!--<div class="clip-me div-sfondo-home" style=""></div>-->

        <div class="container-xxl">
            <img class="logo-landlord" src="{{ Storage::url(App\Models\Setting::find('app_logo')->value)}}">
            <h1 class="mt-3 titolo-1 green font-weight-bold">{{App\Models\Setting::find('app_ordini_titolo')->value}}</h1>
            <h5 class="mt-3 titolo-2 mid-green">{{App\Models\Setting::find('app_ordini_sottotitolo')->value}}</h5>
            <p class="grigetto">{{App\Models\Setting::find('app_ordini_descrizione')->value}}</p>
        </div>
     
        <div class="new-app-banner-bg-shape"><img src="/img/maschera-desktop.png" alt="image" style="width:100%;"></div>
    </div>
    <div class="d-block d-md-none py-5 px-3">
        {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
        <!--<div class="clip-me div-sfondo-home" style=""></div>-->

        <div class="row align-items-center ">
            <div class="col-5 text-center"> <img class="logo-landlord" src="{{ Storage::url(App\Models\Setting::find('app_logo')->value)}}"></div>
            <div class="col-7">
                <h1 class="mt-3 titolo-1 green font-weight-bold">{{App\Models\Setting::find('app_ordini_titolo')->value}}</h1>
                <h5 class="mt-3 titolo-2 mid-green">{{App\Models\Setting::find('app_ordini_sottotitolo')->value}}</h5>
                <p class="grigetto">{{App\Models\Setting::find('app_ordini_descrizione')->value}}</p>
            </div>
        </div>
    </div>
    <livewire:orderlivewire />
  

@endsection

