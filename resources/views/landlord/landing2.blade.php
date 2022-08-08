@extends('landlord.layouts.app')

{{--@section('Ordina', __('Ordina'))--}}

@section('content')
<div id="home" class="div-copertina new-app-main-banner-area align-items-center" style="min-height: 550px; background-image:url('{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}');">
    {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
    <!--<div class="clip-me div-sfondo-home" style=""></div>-->

    {{--<div class="container mt-2 mt-md-5 d-flex justify-content-between">
        <img class="logo-landlord" src="img/logotipo_1.png" style="margin-left:-23px;">
    </div>--}}
   
        <nav class="navbar navbar-expand-lg navbar-light fixed-md-top" style="background-color: rgba(224,235, 196, .95);">
            <div class="container">
                <a class="navbar-brand" href="#"> <img class="logo-landlord" src="img/logotipo_1.png" style="margin-left:-10px;"></a>
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
                        <div class="d-flex align-items-center ml-3">
                            <a href="https://www.facebook.com/" target="blank" class="d-flex align-items-center green"><i class="fab fa-facebook-square fa-2x mr-2"></i></a>
                            <a href="https://www.instagram.com/" target="blank" class="d-flex align-items-center green"><i class="fab fa-instagram-square fa-2x mr-2"></i></a>
                            <a href="mailto:info@radicando.it" target="blank" class="d-flex align-items-center green"> <i class="fas fa-envelope-square fa-2x mr-2"></i></a>
                            <a href="tel:+393384533261" target="blank" class="d-flex align-items-center green"> <i class="fab fa-whatsapp-square fa-2x"></i></a>
                        
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container text-center text-md-left" >
        <div class="header-copertina mt-2 mt-md-5">
            <h2 class="mt-3 titolo-h2">Agricoltura innovativa</h2>
            <p class="sottotitolo-1">Gestire la tua azienda agricola non è <br />mai stato così semplice!</p>
            <div class="my-3">
                <a class="btn btn-orange bordotondomolto text-uppercase p-2 mr-2" target="blank" href="https://demo.radicando.it/">Pagina ordini</a>
                <a class="btn btn-orange bordotondomolto text-uppercase p-2" target="blank" href="https://demo.radicando.it/login">Demo gestionale</a>
            </div>
        </div>
    </div>
    <div class="d-none d-md-block new-app-banner-bg-shape"><img src="/img/presentazione/sagoma_onda2.png" alt="image"></div>
</div>
<div class="bg-white" id="progetto">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6">
                <img src="/img/presentazione/esagono.jpg" class="img-fluid p-4" style="max-height:530px;">  
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
        <div class="py-5" style="max-width: 900px; margin: auto;">
            <div class="row">
                <div class="col-6 col-md-3">
                    <div class="card bordotondomolto bg-verdolino">
                      
                        <div class="card-body text-center dark-green p-3">
                            <img class="img-fluid mb-4" src="/img/presentazione/icona_foglia.png" style="max-width:85px;">
                            <h4>MONITORAGGIO</h4>
                            <h6>COLTIVAZIONI ed<br />ALLEVAMENTI</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card bordotondomolto bg-verdolino">
                      
                        <div class="card-body text-center dark-green p-3">
                            <img class="img-fluid mb-4" src="/img/presentazione/icona_diario.png" style="max-width:85px;">
                            <h4>COMPILAZIONE</h4>
                            <h6>DIARIO e<br />MAGAZZINO</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card bordotondomolto bg-verdolino">
                       
                        <div class="card-body text-center dark-green p-3">
                            <img class="img-fluid mb-4" src="/img/presentazione/icona_negozio.png" style="max-width:85px;">
                            <h4>VENDITA</h4>
                            <h6>PRODUZIONE ed<br />ORDINI</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card bordotondomolto bg-verdolino">
                    
                        <div class="card-body text-center dark-green p-3">
                            <img class="img-fluid mb-4" src="/img/presentazione/statistiche.png" style="max-width:85px;">
                            <h4>STATISTICHE</h4>
                            <h6>COSTI, RESI e<br />RICAVI</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="bg-verdolino" id="funzioni">
    <div class="container-xxl py-5">
        <h5 class="text-center orange pt-5">Ti aiutiamo a decidere cosa, devo e quando piantare</h5>
        <h2 class="titolo-h2 text-center">Coltiviamo insieme</h2>
       
        <div class="row py-4">
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <div class="card-body">
                        <img src="/img/presentazione/schermate/elenco_piante.png" alt="" class="img-fluid">
                        <h5 class="card-title">Elenco Piante</h5>
                        <p class="card-text">Non un semplice elenco ma una vera e propria guida alla coltivazione.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <div class="card-body">
                        <img src="/img/presentazione/schermate/coltivazioni.png" alt="" class="img-fluid">
                        <h5 class="card-title">Gestione Terreni e Coltivazioni</h5>
                        <p class="card-text">Vedi tutte le proprietà in una sola schermata, fai il punto delle coltivazioni presenti.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <div class="card-body">
                        <img src="/img/presentazione/schermate/diario.png" alt="" class="img-fluid">
                        <h5 class="card-title">Gestione attività</h5>
                        <p class="card-text">Tieni il registro degli interventi e dei trattamenti, scegli quando seminare e monitora il raccolto e le rese.</p>
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
               <p>Soprattutto nella gestione degli ordini di orticole ma anche per la prenotazione dei prodotti, quando si tratta di organizzare le cose Radicando ti aiuta! Puoi ordinare per data di ordine o per luogo di consegna ed inoltre puoi fare la somma dei singoli prodotti richiesti per valutare da subito il giusto quantitativo da raccogliere o da preparare.</p>
                <div class="clearfix mt-4">
                    <img class="float-left mr-4" src="/img/presentazione/ordini.png" height="100px">
                    <h4 class="text-bold">SEMPLIFICA LE VENDITE</h4>
                    <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire
                        la tua attività direttamente online grazie ad un software che
                        pensa a tutto.</p>
                </div>
                <div class="clearfix  mt-4">
                    <img class="float-left mr-4" src="/img/presentazione/vetrina_ordini.png" height="100px">
                    <h4 class="text-bold">OTTIMIZZA L'ORGANIZZAZIONE</h4>
                    <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire
                        la tua attività direttamente online grazie ad un software che
                        pensa a tutto.</p>
                </div>
            </div>
           <div class="col-12 col-md-6 text-center"><img class="img-fluid" src="/img/presentazione/computer2.jpg" style="width:80%" ></div>
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
                    <div class="card bordotondomolto  card-ribbon green mb-3 mx-auto" data-label="MENSILE">
                        <div class="card__container mt-5 text-center">
                            <h4>In promozione fino al 31/12</h4>
                            <span class="h1 font-weight-bold green"><s>39€</s> </span><span class="font-weight-bold green">/mese</span>
                            <span class="h1 font-weight-bold orange" style="font-size: 3.5rem;">29€ </span><span class="font-weight-bold green">/mese</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="container">
                    <div class="card bordotondomolto card-ribbon orange mb-3 mx-auto" data-label="ANNUALE">
                        <div class="card__container mt-5 text-center">
                            <h4>In promozione fino al 31/12</h4>
                            <span class="h1 font-weight-bold green"><s>449€</s> </span><span class="font-weight-bold green">/anno</span>
                            <span class="h1 font-weight-bold orange" style="font-size: 3.5rem;">299€ </span><span class="font-weight-bold green">/anno</span>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
</div>
<div class="bg-white p-3 p-md-5" id="contatti">
    <div class="card bordotondomolto bg-green my-5 mx-auto" style="max-width:600px;">
        <div class="card-body text-center">
            <h5 class="text-center orange pt-5">PER INFORMAZIONI</h5>
            <h1 class="titolo-h2 text-center">Contattaci</h1>
            <form method="post" action="landing#contatti">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control @error('name') is-invalid @enderror mx-auto mt-3" name="name" placeholder="Nome e Cognome" style="max-width:400px">
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>Nome non valido</strong></span>
                    @enderror
                    <input type="email" class="form-control @error('email') is-invalid @enderror mx-auto mt-3" name="email" placeholder="Email" style="max-width:400px">
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>Email non valida</strong></span>
                    @enderror
                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror mx-auto mt-3" name="phone_number" placeholder="Telefono" style="max-width:400px">
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert"><strong>Numero di telefono non valido</strong></span>
                    @enderror
                    {{--<input type="text" class="form-control @error('subject') is-invalid @enderror mx-auto mt-3" name="subject" placeholder="Titolo" style="max-width:400px">
                    @error('subject')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror--}}
                    <textarea class="form-control textarea @error('message') is-invalid @enderror mx-auto mt-3" name="message" placeholder="Cosa vorresti sapere?" style="max-width:400px"></textarea>
                    @error('message')
                        <span class="invalid-feedback" role="alert"><strong>Inserisci un messagio</strong></span>
                    @enderror
                    <div class="form-check mt-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="privacy">
                        <label class="form-check-label" for="exampleCheck1">Accetto la <a href="https://www.iubenda.com/privacy-policy/17494189" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a></label>
                    </div> 
                    @error('privacy')
                        <span class="invalid-feedback" role="alert"><strong>Devi accettare la privacy</strong></span>
                    @enderror
                    <button type="submit" class="btn btn-orange bordotondomolto  mt-3 px-4">Invia</button>
                </div>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
               
            </form>
        </div>
    </div>
</div>
<footer>
    <div class="div-copertina new-app-main-banner-area align-items-center bg-verdolino">
        <div class="container my-4">
            <img class="logo-landlord my-4" src="img/logotipo_1.png" height="60" style="margin-left:-10px; "><br />
            <p><b>Radicando</b> - agricoltura online.</p>
            <p>www.radicando.it - info@radicando.it</p><br/>
            <p>Un progetto di Key Soluzioni di Cappannari Michele e ESSEPPI multimedia di Pianesi Simone</p>
            <p>P.IVA 02517400426</p>
            <div>
                <a href="https://www.facebook.com/" target="blank" class="green"><i class="fab fa-facebook-square fa-2x mr-3"></i></a>
                <a href="https://www.instagram.com/" target="blank" class="green"><i class="fab fa-instagram-square fa-2x mr-3"></i></a>
                <a href="mailto:info@radicando.it" target="blank" class="green"> <i class="fas fa-envelope-square fa-2x mr-3"></i></a>
                <a href="tel:+393384533261" target="blank" class="green"> <i class="fab fa-whatsapp-square fa-2x"></i></a>
            
            </div>
        </div>
        <div class="d-none d-md-block new-app-banner-bg-shape"><img src="/img/presentazione/sagoma_footer.png" alt="image"></div>
    </div>
    <div class="bg-green p-3 text-center">
      
        Copyright © 2022 Radicando - <span class="orange">Agricoltura online</span> - Tutti i diritti riservati 
        <a href="https://www.iubenda.com/privacy-policy/17494189" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a>
        
    </div>
</footer>
@endsection



