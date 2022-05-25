@extends('frontend.layouts.app')

@section('Ordina', __('Ordina'))

@push('after-styles')
    <style>
        .flip-card {
            background-color: transparent;
            border: 1px solid #f1f1f1;
            perspective: 1000px; /* Remove this if you don't want the 3D effect */
        }
        .flipcard {
            transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
        }
        .card-flip {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            -moz-transition: -moz-transform 0.8s;
            -webkit-transition: -webkit-transform 0.8s;
            transform-style: preserve-3d;
        }
        .front {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            background: #f3f3f3;
            color: #333;
            text-align:center;   
        }
        .back {
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            background: #919191;
            color: white;
            text-align:center;   
             transform: rotateY(180deg);
            -moz-transform: rotateY(180deg);
            -webkit-transform: rotateY(180deg);
            -o-transform: rotateY(180deg);
        }
    </style>
@endpush

@section('content')
<div class="container-xxl">
    <livewire:orderlivewire />
</div>
@endsection

