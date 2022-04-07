@extends('frontend.layouts.app')

@section('Ordina', __('Ordina'))

@section('content')
<img class="w-100" src="{{ Storage::url(App\Models\Setting::find('app_img_copertina')->value)}}">
<div class="container">
    <h1>Benvenuto</h1>
</div>
@endsection

