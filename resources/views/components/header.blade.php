<header>
  <nav class="navbar navbar-expand-lg navbar-light position-fixed ">
    <div class="container-fluid d-flex align-items-center">

        {{-- logo --}}
        <a class="navbar-brand align-items-center" href="">
          <img class="img-logo" src="" alt="Deliveboo logo">
        </a>

        {{-- bottone hamburger menu su schermi piccoli --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false">
          <span class="navbar-toggler-icon"></span>
        </button>        

        {{-- voci menu --}}
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav d-flex align-items-end hamb-menu-clicked">
            <a class="nav-link" href="#">Collabora con noi</a>
            <a class="nav-link" href="#">Menu</a>

            @auth
              {{-- voci menu visibili se loggati --}}
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
              </a>
              <a class="btn btn-return-restaurant" href="">Ritorna al tuo ristorante</a>
              <a class="btn btn-danger exit-btn" href="{{ route('logout') }}"onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();"
                > {{ __('Logout') }} </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
              
              @else
              {{-- voce menu visibile se non loggati --}}
              <a class="register-btn" href="{{ route('register') }}">Diventa nostro partner</a>
            @endauth
          </div>
        </div>
    </div>
  </nav>
</header>