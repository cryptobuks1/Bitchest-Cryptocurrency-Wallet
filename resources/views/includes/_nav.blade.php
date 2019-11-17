
<div class="wrapper">
    <div class="sidebar">
        <a class="navbar-brand" href="#"><img src="{{asset('images/bitchest_logo.png')}}" alt="Bitchest"  class="img-responsive" width= "150";></a>
        
        <ul>
            <li><a id="liste" href="{{ route('personaldata') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Infos Personnelles</a></li>

            <li><a id="liste" href="{{route ('Admin.index')}}"><i class="fa fa-users" aria-hidden="true"></i> Nos Clients</a></li>

            <li><a id="liste" href="Admin.crypto_monnaie"><i class="fa fa-money" aria-hidden="true"></i>
             Crypto Monnaies</a></li>

            <li >
              <a id="liste" class="" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><i class="fa fa-trash" aria-hidden="true"></i>
                 {{ __('Se Deconnecter') }}

              </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
           </li>

           
          
        </ul>

        <div class="social_media">
          <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
      </div>
    </div>
