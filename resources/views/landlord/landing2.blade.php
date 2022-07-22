@extends('landlord.layouts.app')
@push('after-styles')
<link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>
<style>
  
    </style>
@endpush
{{--@section('Ordina', __('Ordina'))--}}

@section('content')
<div class="div-copertina new-app-main-banner-area align-items-center" style="min-height: 500px; background-image:url('{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}');">
    {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
    <!--<div class="clip-me div-sfondo-home" style=""></div>-->

    <div class="container mt-2 mt-md-5">
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
    <div class="new-app-banner-bg-shape"><img src="/img/presentazione/sagoma_onda2.png" alt="image"></div>
</div>
<div class="bg-white">
    <div class="container-fluid p-5">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <img src="/img/presentazione/esagono.jpg" class="img-fluid p-4" style="max-height:580px;">  
            </div>
            <div class="col-12 col-md-6">   
                <h4 class="orange">LA NOSTRA VISIONE</h4>
                <h2 class="titolo-h2">Agricoltura 4.0</h2>
                <p>Nell'era digitale è sempre più importante ottimizzare il lavoro nelle aziende agricole e rendere più efficace la gestione di tutti i sistemi,
                    dalla coltivazione alla vendita, fino a  
                    tenere nota di tutte le attività svolte in un vero e proprio diario dell'agricoltore. 
                </p>
                <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire la tua attività direttamente online grazie ad un software che pensa a tutto.</p>
                <div class="clearfix">
                    <img class="float-left mr-4" src="/img/presentazione/coltivazioni.png" height="100px">
                    <h4>SOFTWARE SMART</h4>
                    <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire
                        la tua attività direttamente online grazie ad un software che
                        pensa a tutto.</p>
                </div>
            </div>     
         
        </div>
    </div>
    <div class="py-5" style="max-width: 900px; margin: auto;">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino h-100">
                    <img class="card-img-top m-auto" src="/img/presentazione/piante.png" style="max-width:100px;">
                    <div class="card-body text-center dark-green p-2">
                        <h4>MONITORAGGIO</h4>
                        <h6>COLTIVAZIONI ed ALLEVAMENTI</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino h-100">
                    <img class="card-img-top m-auto" src="/img/presentazione/diario.png" style="max-width:100px;">
                    <div class="card-body text-center dark-green p-2">
                        <h4>COMPILAZIONE</h4>
                        <h6>DIARIO e MAGAZZINO</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino h-100">
                    <img class="card-img-top m-auto" src="/img/presentazione/ordini.png" style="max-width:100px;">
                    <div class="card-body text-center dark-green p-2">
                        <h4>VENDITA</h4>
                        <h6>PRODUZIONE ed ORDINI</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino h-100">
                    <img class="card-img-top m-auto" src="/img/presentazione/raccolto.png" style="max-width:100px;">
                    <div class="card-body text-center dark-green p-2">
                        <h4>STATISTICHE</h4>
                        <h6>COSTI, RESI e RICAVI</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-verdolino">
    <div class="container-xxl py-5">
        <h1 class="titolo-h1 text-center pt-5">Coltiviamo insieme</h1>
        <h5 class="text-center orange">Ti aiutiamo a decidere cosa, devo e quando piantare</h5>
        <div class="row py-4">
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/piante.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Elenco Piante ed Animali</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/terreni.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Gestione Terreni</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/coltivazioni.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Gestione Coltivazioni ed Allevamenti</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-white">
    <div class="container py-5">
        <h5 class="orange pt-5">VENDI i tuoi prodotti</h5>
        <h2 class="titolo-h2">Una sezione dedicata agli ordini</h2>
      
        <div class="row py-4">
           <div class="col-12 col-md-6">
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore.</p>
                <div class="clearfix mt-3">
                    <img class="float-left mr-4" src="/img/presentazione/ordini.png" height="100px">
                    <h4 class="text-bold">SEMPLIFICA LE VENDITE</h4>
                    <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire
                        la tua attività direttamente online grazie ad un software che
                        pensa a tutto.</p>
                </div>
                <div class="clearfix  mt-3">
                    <img class="float-left mr-4" src="/img/presentazione/vetrina_ordini.png" height="100px">
                    <h4 class="text-bold">OTTIMIZZA L'ORGANIZZAZIONE</h4>
                    <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire
                        la tua attività direttamente online grazie ad un software che
                        pensa a tutto.</p>
                </div>
            </div>
           <div class="col-12 col-md-6"><img class="img-fluid" src="/img/presentazione/computer.jpg" style="width:80%" ></div>
        </div>
        <div class="d-none d-md-block" style="min-height:150px;"></div>
   
    </div>
</div>
<div class="bg-green">
    <div class="container" style="max-width: 900px; margin: auto;">
        <div class="row trans-md-50-y">
            <div class="col-6 col-md-3 text-center"><img class="img-fluid" src="/img/presentazione/tel_1.png" ></div>
            <div class="col-6 col-md-3 text-center"><img class="img-fluid" src="/img/presentazione/tel_2.png" ></div>
            <div class="col-6 col-md-3 text-center"><img class="img-fluid" src="/img/presentazione/tel_3.png" ></div>
            <div class="col-6 col-md-3 text-center"><img class="img-fluid" src="/img/presentazione/tel_4.png" ></div>
        </div>
    </div>
</div>
<div class="bg-verdolino">
    <div class="container py-5">
        <h5 class="text-center orange pt-5">I NOSTRI PACCHETTI</h5>
        <h1 class="titolo-h2 text-center">Scegli il tuo piano</h1>
        
        <div class="row py-4">
            <div class="col-12 col-md-6">
                <div class="container">
                    <div class="card card-ribbon green m-auto" data-label="In Progress">
                        <div class="card__container">
                            <h3>Solo Ordini</h3>
                            <span class="h1 font-weight-bold orange">29€ </span><span class="font-weight-bold green">/mese</span><br/>
                            <span class="h1 font-weight-bold orange">299€ </span><span class="font-weight-bold green">/anno</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="container">
                    <div class="card card-ribbon orange m-auto" data-label="In Progress">
                        <div class="card__container">
                            <h3>Solo Ordini</h3>
                            <span class="h1 font-weight-bold orange">29€ </span><span class="font-weight-bold green">/mese</span><br/>
                            <span class="h1 font-weight-bold orange">299€ </span><span class="font-weight-bold green">/anno</span>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<div class="bg-white p-5">
    <div class="card bg-green m-auto" style="max-width:600px;">
        <div class="card-body">
            <h5 class="text-center orange pt-5">PER INFORMAZIONI</h5>
            <h1 class="titolo-h2 text-center">Contattaci</h1>
        </div>
    </div>
</div>
<div class="container">
    <img class="logo-landlord" src="img/logotipo_1.png" style="margin-left:-23px;">
</div>
@endsection


