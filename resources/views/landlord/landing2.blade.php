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
<div class="div-copertina new-app-main-banner-area" style="background-image:url('{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}');">
    {{--<img class="img-copertina clip-me" src="{{ Storage::url('public/tenant/demo/profilo/copertina.jpg')}}">--}}
    <!--<div class="clip-me div-sfondo-home" style=""></div>-->

    <div class="container-xxl">
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
    <div class="new-app-banner-bg-shape"><img src="/img/presentazione/banner-shape.png" alt="image"></div>
</div>
<div class="bg-verdolino">
    <div class="py-5 container-xxl">
        <h1 class="titolo-h1">La nostra visione</h1>
        <p>Nell'era digitale è sempre più importante ottimizzare il lavoro nelle aziende agricole e rendere più efficace la gestione di tutti i sistemi,
             dalla coltivazione alla vendita, fino a  
            tenere nota di tutte le attività svolte in un vero e proprio diario dell'agricoltore. 
        </p>
        <p>Finalmente ora è tutto più semplice, con Radicando puoi gestire la tua attività direttamente online grazie ad un software che pensa a tutto.</p>
        
    </div>
</div>
<div class="bg-green">
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
    <div class="container-xxl py-5">
        <h1 class="titolo-h1 text-center pt-5">Lavoriamo insieme</h1>
        <h5 class="text-center orange">Ti aiutiamo a decidere cosa, devo e quando piantare</h5>
        <div class="row py-4">
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/piante.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Diario e Registri</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/terreni.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Raccolto e Magazzino</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/coltivazioni.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Prodotti e Trasformati</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-verdolino">
    <div class="container-xxl py-5">
        <h1 class="titolo-h1 text-center pt-5">Facciamo i conti</h1>
        <h5 class="text-center orange">Ti aiutiamo a decidere cosa, devo e quando piantare</h5>
        <div class="row py-4">
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/piante.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Costi</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/terreni.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Rese</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-home m-4">
                    <img src="/img/presentazione/coltivazioni.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Ricavi</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xxl">
        <!-- Slider main container -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-5.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-6.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-7.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-8.jpg" />
              </div>
              <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-9.jpg" />
              </div>
            </div>
            <div class="swiper-pagination"></div>
          </div>
    </div>
</div>
@endsection

@push('after-scripts')
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
@endpush
