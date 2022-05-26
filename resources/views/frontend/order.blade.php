@extends('frontend.layouts.app')


@section('top')
    <div class="text-center bg-lightgrey py-4" >
        <h1>Prenota ora</h1>
        <span>L'orto è sempre in divenire, qui trovi i prodotti attualmente disponibili</span>
    </div>
@endsection

@section('content')
<div class="container-xxl">
    <livewire:orderlivewire />
</div>
@endsection

