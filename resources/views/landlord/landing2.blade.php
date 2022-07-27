@extends('landlord.layouts.app')

{{--@section('Ordina', __('Ordina'))--}}

@section('content')
<div class="div-copertina new-app-main-banner-area align-items-center" style="min-height: 500px; background-image:url('{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}');">
    {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
    <!--<div class="clip-me div-sfondo-home" style=""></div>-->

    {{--<div class="container mt-2 mt-md-5 d-flex justify-content-between">
        <img class="logo-landlord" src="img/logotipo_1.png" style="margin-left:-23px;">
    </div>--}}
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#"> <img class="logo-landlord" src="img/logotipo_1.png" style="margin-left:-23px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#progetto">Il progetto</a></li>
                    <li class="nav-item"><a class="nav-link" href="#funzioni">Funzioni</a></li>
                    <li class="nav-item"><a class="nav-link" href="#prezzi">Prezzi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contatti">Contatti</a></li>
                </ul>
            </div>
        </nav>
        <div class="mt-2 mt-md-5">
            <h3 class="mt-3 titolo-1">Agricoltura innovativa</h3>
            <p class="sottotitolo-1">Gestire la tua azienda agricola non è <br />mai stato così semplice!</p>
            <div class="my-3">
                <a class="btn btn-orange" href="#">Demo lato pubblico</a>
                <a class="btn btn-orange" href="#">Demo lato gestionale</a>
            </div>
            <div>
                <h5>Visita i nostri canali, o contattaci</h5>
                <a href="https://www.facebook.com/" target="blank" class="green"><i class="fab fa-facebook-square fa-3x mr-3"></i></a>
                <a href="https://www.instagram.com/" target="blank" class="green"><i class="fab fa-instagram-square fa-3x mr-3"></i></a>
                <a href="mailto:info@radicando.it" target="blank" class="green"> <i class="fas fa-envelope-square fa-3x mr-3"></i></a>
                <a href="tel:+393384533261" target="blank" class="green"> <i class="fab fa-whatsapp-square fa-3x"></i></a>
            
            </div>
        </div>
    </div>
    <div class="new-app-banner-bg-shape"><img src="/img/presentazione/sagoma_onda2.png" alt="image"></div>
</div>
<div class="bg-white" id="progetto">
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
                <div class="card bg-verdolino">
                  
                    <div class="card-body text-center dark-green p-3">
                        <img class="mb-3" src="/img/presentazione/icona_foglia.png" style="max-width:100px;">
                        <h4>MONITORAGGIO</h4>
                        <h6>COLTIVAZIONI ed<br />ALLEVAMENTI</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino">
                  
                    <div class="card-body text-center dark-green p-3">
                        <img class="mb-3" src="/img/presentazione/icona_diario.png" style="max-width:100px;">
                        <h4>COMPILAZIONE</h4>
                        <h6>DIARIO e<br />MAGAZZINO</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino">
                   
                    <div class="card-body text-center dark-green p-3">
                        <img class="mb-3" src="/img/presentazione/icona_negozio.png" style="max-width:100px;">
                        <h4>VENDITA</h4>
                        <h6>PRODUZIONE ed<br />ORDINI</h6>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-verdolino">
                
                    <div class="card-body text-center dark-green p-3">
                        <img class="mb-3" src="/img/presentazione/statistiche.png" style="max-width:100px;">
                        <h4>STATISTICHE</h4>
                        <h6>COSTI, RESI e<br />RICAVI</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-verdolino" id="funzioni">
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
<div class="bg-verdolino" id="prezzi">
    <div class="container py-5">
        <h5 class="text-center orange pt-5">PREZZI</h5>
        <h1 class="titolo-h2 text-center">Scegli il tuo piano</h1>
        
        <div class="row py-4">
            <div class="col-12 col-md-6">
                <div class="container">
                    <div class="card card-ribbon green m-auto" data-label="MENSILE">
                        <div class="card__container mt-5 text-center">
                            <h4>In promozione fino al 31/10</h4>
                            <span class="h1 font-weight-bold orange"><s>39€</s> </span><span class="font-weight-bold green">/mese</span>
                            <span class="h1 font-weight-bold orange">29€ </span><span class="font-weight-bold green">/mese</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="container">
                    <div class="card card-ribbon orange m-auto" data-label="ANNUALE">
                        <div class="card__container mt-5 text-center">
                            <h4>In promozione fino al 31/10</h4>
                            <span class="h1 font-weight-bold orange"><s>449€</s> </span><span class="font-weight-bold green">/anno</span>
                            <span class="h1 font-weight-bold orange">299€ </span><span class="font-weight-bold green">/anno</span>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<div class="bg-white p-5" id="contatti">
    <div class="card bg-green m-auto" style="max-width:600px;">
        <div class="card-body text-center">
            <h5 class="text-center orange pt-5">PER INFORMAZIONI</h5>
            <h1 class="titolo-h2 text-center">Contattaci</h1>
            <div class="form-group">
                <input type="text" class="form-control mx-auto mt-3" name="nome" placeholder="Nome e Cognome" style="max-width:400px">
                <input type="email" class="form-control mx-auto mt-3" name="nome" placeholder="Email" style="max-width:400px">
                <textarea class="form-control mx-auto mt-3" name="descrizione" placeholder="Cosa vorresti sapere?" style="max-width:400px"></textarea>
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="privacy">
                    <label class="form-check-label" for="exampleCheck1">Accetto la Privacy policy</label>
                </div> 
                <input type="submit" class="btn btn-orange mt-3 px-4" value="Invia">
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="div-copertina new-app-main-banner-area align-items-center bg-verdolino">
        <div class="container my-4">
            <img class="logo-landlord mb-3" src="img/logotipo_1.png" height="60" style="margin-left:-10px; "><br />
            <p>Radicando - agricoltura online.</p>
            <p>www.radicando.it - info@radicando.it</p>
            <p>Un progetto di Key Soluzioni di Cappannari Michele e ESSEPPI multimedia di Pianesi Simone</p>
            <div>
                <a href="https://www.facebook.com/" target="blank" class="green"><i class="fab fa-facebook-square fa-2x mr-3"></i></a>
                <a href="https://www.instagram.com/" target="blank" class="green"><i class="fab fa-instagram-square fa-2x mr-3"></i></a>
                <a href="mailto:info@radicando.it" target="blank" class="green"> <i class="fas fa-envelope-square fa-2x mr-3"></i></a>
                <a href="tel:+393384533261" target="blank" class="green"> <i class="fab fa-whatsapp-square fa-2x"></i></a>
            
            </div>
        </div>
        <div class="new-app-banner-bg-shape"><img src="/img/presentazione/sagoma_footer.png" alt="image"></div>
    </div>
    <div class="bg-green p-3 text-center">
        Copyright © 2022 Radicando - <span class="orange">Agricoltura online</span> - Tutti i diritti riservati | <a href="">Cookie Policy</a> | <a href="">Privacy Policy</a>
    </div>
</footer>
@endsection


