<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="TechyDevs" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <title>AkilaEven - Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('assets_site/css/jquery-ui.css')}}" />
    {{-- <link rel="stylesheet" href="{{asset('assets_site/css/style.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('assets_site/styles.css')}}" />
    <!-- Template CSS Files --> 
    <link rel="stylesheet" href="{{asset('assets_site/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/line-awesome.css')}}" />

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
     
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <style>
      .img-icone {width: 1.5rem; margin: 3px;}
    </style>
  </head>
  <body class=" bg-background">
    <x-admin.toast-container />
    @include("admin.layouts.header-admin")
    @include("admin.layouts.sidebar")
    @yield('content-admin')

  <!-- Template JS Files -->
<script src="{{asset('assets_site/js/jquery-3.7.1.min.js')}}"></script>

<!--  <script src="{{asset('assets_site/js/jquery-3.4.1.min.js')}}"></script> -->
<script src="{{asset('assets_site/js/jquery-ui.js')}}"></script>


<script src="{{asset('assets_site/js/moment.min.js')}}"></script>
<script src="{{asset('assets_site/js/daterangepicker.js')}}"></script>

<script src="{{asset('assets_site/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.countTo.min.js')}}"></script>
<script src="{{asset('assets_site/js/animated-headline.js')}}"></script>
<script src="{{asset('assets_site/js/jquery.ripples-min.js')}}"></script>
<script src="{{asset('assets_site/js/quantity-input.js')}}"></script>


<script src="{{asset('assets_site/js/main.js')}}"></script>
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
{{--  <script src="https://unpkg.com/lucide@latest"></script> --}}
<!-- Initialize Lucide Icons -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
      lucide.createIcons();
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<!-- Scripts supplémentaires -->
  @stack('scripts')
</body>

</html>
