<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="TechyDevs" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @vite('resources/css/app.css')
    <title>AkilaEven - Réservation de salles de fêtes et locations d'agence</title>
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap"
      rel="stylesheet"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Template CSS Files -->
    <link rel="stylesheet" href="{{asset('assets_site/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/line-awesome.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets_site/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/owl.theme.default.min.css')}}" />
    
    <link rel="stylesheet" href="{{asset('assets_site/css/jquery.fancybox.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/daterangepicker.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/animated-headline.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/flag-icon.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets_site/styles.css')}}" />
    <link rel="stylesheet" href="{{asset('css/social-media.css')}}" />
    <!-- Swiper pour le carrousel-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/resources/css/app.css" />


    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
   
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

    @include('site.layouts.partials.site-header')

    @yield('content-site')

    @include('site.layouts.partials.site-footer')

  <!-- Template JS Files -->
  <script src="{{asset('assets_site/js/jquery-3.7.1.min.js')}}"></script>
 
 <!--  <script src="{{asset('assets_site/js/jquery-3.4.1.min.js')}}"></script> -->
  <script src="{{asset('assets_site/js/jquery-ui.js')}}"></script>

  <script src="{{asset('assets_site/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets_site/js/select2.min.js')}}"></script>

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
  <script>
    lucide.createIcons();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script>
  
  document.addEventListener('DOMContentLoaded', function() {
    const commonConfig = {
      slidesPerView: 1,
      spaceBetween: 10,
      grabCursor: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      breakpoints: {
        640:  { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
      },
      keyboard:   { enabled: true },
      /* mousewheel: { invert: false }, */
      a11y: {
        prevSlideMessage: 'Slide précédente',
        nextSlideMessage: 'Slide suivante',
      },
      effect: 'slide',
      // Navigation arrows
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },            
      // Pagination
      pagination: {
          el: '.swiper-pagination',
          clickable: true,
          dynamicBullets: true,
      },
    };
    document.querySelectorAll('.swiper').forEach(container => {
      const data = container.dataset;
      const override = {};

      // — Autoplay, slidesPerView, spaceBetween, etc. comme avant —
      if (data.autoplay === 'false') override.autoplay = false;
      if (data.slidesPerView)   override.slidesPerView  = parseInt(data.slidesPerView, 10);
      if (data.spaceBetween)    override.spaceBetween   = parseInt(data.spaceBetween, 10);
      // ...

      // — Gestion des breakpoints —

      if (data.breakpoints === '0') {
        // cas « disable all breakpoints »
        override.breakpoints = {};
      } else {
        // on cherche tous les data-breakpoint-XXX-...
        const bpOverrides = {};
        container.getAttributeNames().forEach(attrName => {
          if (!attrName.startsWith('data-breakpoint-')) return;
          // ex. "data-breakpoint-640-slides-per-view"
          const parts = attrName.slice(5).split('-');
          if (parts.length < 3) return;

          const width    = parts[1]; // "640"
          const propCamel = parts
            .slice(2)
            .map((chunk, i) => i === 0 ? chunk : chunk[0].toUpperCase() + chunk.slice(1))
            .join('');           // "slidesPerView" ou "spaceBetween"

          const raw = container.getAttribute(attrName);
          const val = /^\d+$/.test(raw) ? parseInt(raw, 10) : raw;
          bpOverrides[width] = bpOverrides[width] || {};
          bpOverrides[width][propCamel] = val;
        });

        if (Object.keys(bpOverrides).length) {
          override.breakpoints = bpOverrides;
        }
      }

      // — Fusion finale —
      const config = {
        ...commonConfig,
        ...override,
        // si override.breakpoints est défini (même {}), on l'utilise ;
        // sinon on garde commonConfig.breakpoints
        breakpoints: override.breakpoints !== undefined
          ? override.breakpoints
          : commonConfig.breakpoints
      };

      new Swiper(container, config);
    })
});

       
</script>
  <!-- Scripts supplémentaires -->
  @stack('scripts')
</body>

</html>
