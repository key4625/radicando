@extends('frontend.layouts.app-index')

@section('Ordina', __('Ordina'))

@section('content')
    <div class="d-none d-md-block new-app-main-banner-area ordina-main-banner-area" style="background-image:url('{{ Storage::url(App\Models\Setting::find('app_img_copertina')->value)}}');">
        {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
        <!--<div class="clip-me div-sfondo-home" style=""></div>-->

        <div class="container-xxl">
            <img class="logo-landlord" src="{{ Storage::url(App\Models\Setting::find('app_logo')->value)}}">
            <h1 class="mt-3 titolo-1 green font-weight-bold w-50">{{App\Models\Setting::find('app_ordini_titolo')->value}}</h1>
            <h5 class="mt-3 titolo-2 mid-green  w-50">{{App\Models\Setting::find('app_ordini_sottotitolo')->value}}</h5>
            <p class="grigetto  w-50">{{App\Models\Setting::find('app_ordini_descrizione')->value}}</p>
        </div>
     
        <div class="new-app-banner-bg-shape"><img src="/img/maschera-desktop.png" alt="image"></div>
    </div>
    <div class="d-block d-md-none pt-4 pb-3 px-3">
        {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
        <!--<div class="clip-me div-sfondo-home" style=""></div>-->

        <div class="row align-items-center ">
            <div class="col-12 text-center"> <img class="logo-landlord" src="{{ Storage::url(App\Models\Setting::find('app_logo')->value)}}"></div>
            <div class="col-12 text-center">
                <h1 class="mt-3 titolo-1 green font-weight-bold">{{App\Models\Setting::find('app_ordini_titolo')->value}}</h1>
                <h5 class="mt-3 titolo-2 mid-green">{{App\Models\Setting::find('app_ordini_sottotitolo')->value}}</h5>
                <p class="grigetto">{{App\Models\Setting::find('app_ordini_descrizione')->value}}</p>
            </div>
        </div>
    </div>
    <livewire:orderlivewire />
@endsection

