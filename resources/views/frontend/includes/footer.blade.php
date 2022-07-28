<div class="autentica">
    @guest
        <a class="btn btn-primary btn-lg text-white" href="{{route('frontend.auth.login')}}"><i class="fas fa-lock fa-lg"></i></a>
    @else
        <a class="btn btn-primary btn-lg text-white" href="{{route('admin.dashboard')}}"><i class="fas fa-lock fa-lg"></i></a>
    @endguest

</div>
<footer class="bg-green p-4 text-center" >
   Copyright &copy; 2022 <a class="lightgreen" href="https://radicando.it">Radicando</a> - <span class="orange">Agircoltura online</span> - Tutti i diritti riservati
   <a href="https://www.iubenda.com/privacy-policy/17494189" class="iubenda-white iubenda-noiframe iubenda-embed iubenda-noiframe " title="Privacy Policy ">Privacy Policy</a>
       
</footer>