
<div class="wrapper">
    <div class="sidebar">
        <a class="navbar-brand" href="#"><img src="{{asset('images/bitchest_logo.png')}}" alt="Bitchest"  class="img-responsive" width= "150";></a>
        
        <ul>
            <li><a id="liste" href="{{ route('personaldatauser') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Infos Personnelles</a></li>

            <li><a id="liste" href="{{ route('wallet') }}"><i class="fa fa-users" aria-hidden="true"></i> Portefeuille</a></li>

            <li><a id="liste" href=""><i class="fa fa-money" aria-hidden="true"></i>
             Achats</a></li>

             <li><a id="liste" href=""><i class="fa fa-money" aria-hidden="true"></i>
             Crypto monnaies</a></li>

             <li><a id="liste" href=""><i class="fa fa-money" aria-hidden="true"></i>
             Solde</a></li>

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
