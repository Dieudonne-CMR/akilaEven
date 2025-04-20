<!-- ================================
     START HEADER AREA
================================= -->
<header class="header-area">
  <div class="header-menu-wrapper padding-right-100px padding-left-100px">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="menu-wrapper justify-content-between" style="padding: 5px 0px;">
            <div class="logo">
              <a href="{{route('home')}}" class="site-logo">AkilaEven</a>
              <div class="menu-toggler">
                <i class="la la-bars"></i>
                <i class="la la-times"></i>
              </div>
              <!-- end menu-toggler -->
            </div>
            <!-- end logo -->
            <div class="main-menu-content">
              <nav>
                <ul>
                  <li>
                    <a href="{{route('home')}}" class="nav-link {{request()->routeIs('home') ? 'active' : ''}}">Accueil</a>
                  </li>
                  <li>
                    <a href="#" class="nav-link">Chambres d'hôtel</a>
                  </li>
                  <li>
                    <a href="{{route('site.sallesfetes')}}" class="nav-link {{request()->routeIs('site.sallesfetes') ? 'active' : ''}}">Salles de fêtes</a>
                  </li>
                  <li>
                    <a href="{{route('site.bl-about.about')}}" class="nav-link {{request()->routeIs('site.bl-about.about') ? 'active' : ''}}">À propos</a>
                  </li>
                  <li>
                    <a href="#" class="nav-link">Contact</a>
                  </li>
                </ul>
              </nav>
            </div>
            <!-- end main-menu-content -->
            <div class="nav-btn">
              @guest
                <a href="{{ route('login') }}" class="theme-btn-outline">Connexion</a>
                <a href="{{ route('register') }}" class="theme-btn">Créer votre espace</a>
              @else
                <a href="{{ route('dashboard') }}" class="theme-btn">Mon espace</a>
              @endguest
            </div>
            <!-- end nav-btn -->
          </div>
          <!-- end menu-wrapper -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container-fluid -->
  </div>
  <!-- end header-menu-wrapper -->
</header>
<!-- ================================
     END HEADER AREA
================================= -->

<style>
  /* Style personnalisé pour la navigation */
  .header-area {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
    background-color: white;
  }
  
  .site-logo {
    font-size: 26px;
    font-weight: 700;
    color: #287dfa;
    text-decoration: none;
    transition: color 0.3s ease;
    letter-spacing: 0.5px;
  }
  
  .site-logo:hover {
    color: #0056b3;
  }
  
  .main-menu-content {
    padding-top: 0px !important;
    margin-left: 0px !important;
    padding-right: 0px !important
}

  .main-menu-content ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  .main-menu-content .nav-link {
    position: relative;
    transition: all 0.3s ease;
    padding: 15px 20px;
    font-weight: 500;
    font-size: 16px;
    color: #333;
    text-decoration: none;
  }
  
  .main-menu-content .nav-link:hover,
  .main-menu-content .nav-link.active {
    color: #287dfa;
  }
  
  .main-menu-content .nav-link:after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 50%;
    width: 0;
    height: 2px;
    background-color: #287dfa;
    transition: all 0.3s ease;
    transform: translateX(-50%);
  }
  
  .main-menu-content .nav-link:hover:after,
  .main-menu-content .nav-link.active:after {
    width: 70%;
  }
  
  .theme-btn-outline {
    border: 2px solid #287dfa;
    color: #287dfa;
    background-color: transparent;
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: 600;
    margin-right: 10px;
    transition: all 0.3s ease;
    display: inline-block;
    text-decoration: none;
  }
  
  .theme-btn-outline:hover {
    background-color: #287dfa;
    color: white;
    text-decoration: none;
  }
  
  .theme-btn {
    background-color: #287dfa;
    color: white;
    border: 2px solid #287dfa;
    padding: 0px 20px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-block;
    text-decoration: none;
  }
  
  .theme-btn:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    color: white;
    text-decoration: none;
  }
  
  /* Styles responsive */
  @media (max-width: 992px) {
    .main-menu-content {
      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;
      background-color: white;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
      display: none;
    }

    .main-menu-content .nav-link {
    
      width: fit-content;
  }
   
    
    .main-menu-content.show {
      display: block;
    }
    
    .main-menu-content ul {
      flex-direction: column;
    }
    
    .menu-toggler {
      display: block;
      font-size: 24px;
      cursor: pointer;
    }
    
    .menu-toggler .la-times {
      display: none;
    }
    
    .menu-toggler.active .la-bars {
      display: none;
    }
    
    .menu-toggler.active .la-times {
      display: inline-block;
    }
  }
</style> 