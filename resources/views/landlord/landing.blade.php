@extends('landlord.layouts.app')

{{--@section('Ordina', __('Ordina'))--}}

@section('content')
<div class="div-copertina">
    {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
    <div class="clip-me div-sfondo-home" style="background-image:url('{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}')"></div>
    <div class="div-present">
        <img class="logo-landlord" src="img/logotipo_1.png" style="margin-left:-23px;">
        <h3 class="mt-3 titolo-1">Agricoltura innovativa</h3>
        <p class="sottotitolo-1">Gestire la tua azienda agricola non è <br />mai stato così semplice!</p>
        <div>
            <a href="https://www.facebook.com/" target="blank" class="green"><i class="fab fa-facebook-square fa-3x mr-3"></i></a>
            <a href="https://www.instagram.com/" target="blank" class="green"><i class="fab fa-instagram-square fa-3x mr-3"></i></a>
            <a href="mailto:info@radicando.it" target="blank" class="green"> <i class="fas fa-envelope-square fa-3x mr-3"></i></a>
            <a href="tel:+393384533261" target="blank" class="green"> <i class="fab fa-whatsapp-square fa-3x"></i></a>
           
        </div>
    </div>
    
</div>
<div class="bg-verdolino">
    <div class="pt-5 container-xxl">
        <h1>La nostra visione</h1>
        <p>Nell'era digitale è sempre più importante ottimizzare il lavoro nelle aziende agricole e rendere più efficace la gestione di tutti i sistemi,
             dalla coltivazione alla vendita, fino a  
            tenere nota di tutte le attività svolte in un vero e proprio diario dell'agricoltore. 
        </p>
        <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire la tua attività direttamente online grazie ad un software che pensa a tutto.</p>
    </div>
</div>
@endsection

