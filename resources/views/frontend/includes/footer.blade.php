<div class="autentica">
    @guest
        <a class="btn btn-primary btn-lg text-white" href="{{route('frontend.auth.login')}}"><i class="fas fa-lock fa-lg"></i></a>
    @else
        <a class="btn btn-primary btn-lg text-white" href="{{route('admin.dashboard')}}"><i class="fas fa-lock fa-lg"></i></a>
    @endguest

</div>
<footer class="bg-green p-4" >
   
</footer>