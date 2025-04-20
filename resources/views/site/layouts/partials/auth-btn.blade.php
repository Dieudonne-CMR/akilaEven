<div class="nav-btn">
              @guest
                <a href="{{ route('login') }}" class="theme-btn-outline">Connexion</a>
                <a href="{{ route('register') }}" class="theme-btn">Créer votre espace</a>
              @else
                <a href="{{ route('dashboard') }}" class="theme-btn">Mon espace</a>
              @endguest
            </div>
            <!-- end nav-btn -->