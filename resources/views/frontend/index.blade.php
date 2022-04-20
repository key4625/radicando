@extends('frontend.layouts.app-index')

@section('Ordina', __('Ordina'))

@section('content')
<div class="div-copertina">
    <div class="div-present">
        <div class="container-xxl">
            <img style="max-height:250px;" src="{{ Storage::url(App\Models\Setting::find('app_logo')->value)}}">
            <h3 class="mt-3">{{App\Models\Setting::find('app_company_name')->value}}</h3>
            <p>{{App\Models\Setting::find('app_descrizione_breve')->value}}</p>
        </div>
    </div>
    <img class="img-copertina clip-me" src="{{ Storage::url(App\Models\Setting::find('app_img_copertina')->value)}}">
</div>
<div class="container-xxl">
    <h1>Benvenuto</h1>
</div>
@endsection

