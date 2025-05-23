<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from techydevs.com/demos/themes/html/trizen-demo/html/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Mar 2025 18:49:42 GMT -->
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="TechyDevs" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>AkilaEven - Détails salle de fête</title>
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('assets_site/css/jquery-ui.css')}}" />
{{--     <link rel="stylesheet" href="{{asset('assets_site/css/style.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('assets_site/styles.css')}}" />

    <!-- Template CSS Files -->
 
    <link rel="stylesheet" href="{{asset('assets_site/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/line-awesome.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/owl.theme.default.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/jquery.fancybox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/animated-headline.css')}}" />
   
    <link rel="stylesheet" href="{{asset('assets_site/css/flag-icon.min.css')}}" />
  
    <link rel="stylesheet" href="{{asset('css/social-media.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <!-- Swiper pour le carrousel mobile -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    
      <!-- Flatpickr pour le calendrier -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
    
  {{--   <script src="https://cdn.tailwindcss.com"></script> --}}
    <style>
      .img-icone {width: 1.5rem; margin: 3px;}
    </style>
  </head>
  <body class="bg-background">
    <!-- start cssload-loader -->
   <!--  <div class="preloader" id="preloader">
      <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
          <circle
            class="path"
            cx="25"
            cy="25"
            r="20"
            fill="none"
            stroke-width="5"
          ></circle>
        </svg>
      </div>
    </div> -->
    <!-- end cssload-loader -->

    @include('site.layouts.site-header')

    @yield('content-site')

    @include('site.layouts.site-footer')

  <!-- Template JS Files -->
  <script src="{{asset('assets_site/js/jquery-3.7.1.min.js')}}"></script>
 
 <!--  <script src="{{asset('assets_site/js/jquery-3.4.1.min.js')}}"></script> -->
  <script src="{{asset('assets_site/js/jquery-ui.js')}}"></script>

{{--   <script src="{{asset('assets_site/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets_site/js/select2.min.js')}}"></script> --}}

  <script src="{{asset('assets_site/js/moment.min.js')}}"></script>
  <script src="{{asset('assets_site/js/daterangepicker.js')}}"></script>
  <script src="{{asset('assets_site/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets_site/js/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('assets_site/js/jquery.countTo.min.js')}}"></script>
  <script src="{{asset('assets_site/js/animated-headline.js')}}"></script>
  <script src="{{asset('assets_site/js/jquery.ripples-min.js')}}"></script>
  <script src="{{asset('assets_site/js/quantity-input.js')}}"></script>
  <script src="{{asset('assets_site/js/jquery.superslides.min.js')}}"></script>
  <script src="{{asset('assets_site/js/superslider-script.js')}}"></script>

  <script src="{{asset('assets_site/js/main.js')}}"></script>
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
 {{--  <script src="https://unpkg.com/lucide@latest"></script> --}}
  <script>
    lucide.createIcons();
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <!-- Scripts supplémentaires -->
  @stack('scripts')
</body>

</html>
