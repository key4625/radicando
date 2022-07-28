<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Radicando | Agricoltura online</title>
    <meta name="description" content="Gestire la tua azienda agricola non è mai stato così semplice!">
    <meta name="author" content="@yield('meta_author', 'Key Soluzioni e Esseppi multimedia')">
    @yield('meta')

    @stack('before-styles')

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZFC8Z06FYC"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-ZFC8Z06FYC');
    </script>
    
    @stack('after-styles')
</head>
<body>
    <div id="app" >
        {{--@include('landlord.includes.nav')--}}
        {{--@include('includes.partials.messages')--}}

        <main>
            @yield('content')
        </main>
    </div><!--app-->

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    <script type="text/javascript">
        var _iub = _iub || [];
        _iub.csConfiguration = {"ccpaAcknowledgeOnDisplay":true,"consentOnContinuedBrowsing":false,"countryDetection":true,"enableCcpa":true,"floatingPreferencesButtonDisplay":"bottom-right","invalidateConsentWithoutLog":true,"perPurposeConsent":true,"siteId":2750476,"whitelabel":false,"cookiePolicyId":17494189,"lang":"it", "banner":{ "acceptButtonDisplay":true,"closeButtonDisplay":false,"customizeButtonDisplay":true,"explicitWithdrawal":true,"listPurposes":true,"position":"float-top-center","rejectButtonDisplay":true }};
        </script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/ccpa/stub.js"></script>
    <script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
    @stack('after-scripts')
</body>
</html>
