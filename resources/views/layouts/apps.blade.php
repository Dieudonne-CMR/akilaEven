<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<!-- Mirrored from wowdash.wowtheme7.com/demo/index-12.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Mar 2025 14:59:01 GMT -->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wowdash - Bootstrap 5 Admin Dashboard HTML Template</title>
  <link rel="icon" type="image/png" href="../assets/images/favicon.png" sizes="16x16">
  <!-- remix icon font css  -->
  <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css')}}">
  <!-- BootStrap css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css')}}">
  <!-- Apex Chart css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/apexcharts.css')}}">
  <!-- Data Table css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/dataTables.min.css')}}">
  <!-- Text Editor css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/editor-katex.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.atom-one-dark.min.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/lib/editor.quill.snow.css')}}">
  <!-- Date picker css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/flatpickr.min.css')}}">
  <!-- Calendar css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/full-calendar.css')}}">
  <!-- Vector Map css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/jquery-jvectormap-2.0.5.css')}}">
  <!-- Popup css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/magnific-popup.css')}}">
  <!-- Slick Slider css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/slick.css')}}">
  <!-- prism css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/prism.css')}}">
  <!-- file upload css -->
  <link rel="stylesheet" href="{{ asset('assets/css/lib/file-upload.css')}}">

  <link rel="stylesheet" href="{{ asset('assets/css/lib/audioplayer.css')}}">
  <!-- main css -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
  
  @stack('style');
</head>

<body>

    @include('layouts.partials.sidebar')   <!-- Inclusion sidebar -->

  <main class="dashboard-main">

    @include('layouts.partials.navbar-header')   <!-- Inclusion navbar-header -->

    <div class="main-content">

        @yield('content')

    </div>

    @include('layouts.partials.d-footer')   <!-- Inclusion du pied de page -->

</main>

<!-- jQuery library js -->
<script src="{{ asset('assets/js/lib/jquery-3.7.1.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js')}}"></script>
<!-- Apex Chart js -->
<script src="{{ asset('assets/js/lib/apexcharts.min.js')}}"></script>
<!-- Data Table js -->
<script src="{{ asset('assets/js/lib/dataTables.min.js')}}"></script>
<!-- Iconify Font js -->
<script src="{{ asset('assets/js/lib/iconify-icon.min.js')}}"></script>
<!-- jQuery UI js -->
<script src="{{ asset('assets/js/lib/jquery-ui.min.js')}}"></script>
<!-- Vector Map js -->
<script src="{{ asset('assets/js/lib/jquery-jvectormap-2.0.5.min.js')}}"></script>
<script src="{{ asset('assets/js/lib/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- Popup js -->
<script src="{{ asset('assets/js/lib/magnifc-popup.min.js')}}"></script>
<!-- Slick Slider js -->
<script src="{{ asset('assets/js/lib/slick.min.js')}}"></script>
<!-- prism js -->
<script src="{{ asset('assets/js/lib/prism.js')}}"></script>
<!-- file upload js -->
<script src="{{ asset('assets/js/lib/file-upload.js')}}"></script>
<!-- audioplayer -->
<script src="{{ asset('assets/js/lib/audioplayer.js')}}"></script>

<!-- main js -->
<script src="{{ asset('assets/js/app.js')}}"></script>
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
<script>
    let table = new DataTable('#dataTable');
</script>

<script>
  // ================================ Semi Circle Gauge chart Start ================================ 
  var options = {
    series: [75],
    chart: {
      width: 400,
      height: 300,
      type: 'radialBar',
      sparkline: {
        enabled: true,
      },
      toolbar: {
        show: false,
      },
    },
    plotOptions: {
      radialBar: {
        offsetY: -24,
        offsetX: -14,
        startAngle: -90,
        endAngle: 90,
        track: {
          background: "#E3E6E9",
          strokeWidth: "70%",
        },
        hollow: {
          size: "70%",
        },
        dataLabels: {
          show: false,

          value: {
            fontSize: '22px',
            fontWeight: 600,
            color: '#487FFF',
            offsetY: 16,
          },
        },
      },
    },
    fill: {
      type: 'gradient',
      colors: ['#9DBAFF'],
      gradient: {
        shade: 'dark',
        type: 'horizontal',
        shadeIntensity: 0.5,
        gradientToColors: ['#487FFF'],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100],
      },
    },
    stroke: {
      lineCap: 'round',
    },
  };

  var chart = new ApexCharts(document.querySelector("#semiCircleGaugeTwo"), options);
  chart.render();
  // ================================ Semi Circle Gauge chart End ================================ 

  // ================================ J Vector Map Start ================================ 
  $('#world-map').vectorMap(
    {
      map: 'world_mill_en',
      backgroundColor: 'transparent',
      borderColor: '#fff',
      borderOpacity: 0.25,
      borderWidth: 0,
      color: '#000000',
      regionStyle: {
        initial: {
          fill: '#D1D5DB'
        }
      },
      markerStyle: {
        initial: {
          r: 5,
          'fill': '#fff',
          'fill-opacity': 1,
          'stroke': '#000',
          'stroke-width': 1,
          'stroke-opacity': 0.4
        },
      },
      markers: [{
        latLng: [35.8617, 104.1954],
        name: 'China : 250'
      },

      {
        latLng: [25.2744, 133.7751],
        name: 'AustrCalia : 250'
      },

      {
        latLng: [36.77, -119.41],
        name: 'USA : 82%'
      },

      {
        latLng: [55.37, -3.41],
        name: 'UK   : 250'
      },

      {
        latLng: [25.20, 55.27],
        name: 'UAE : 250'
      }],

      series: {
        regions: [{
          values: {
            "US": '#487FFF ',
            "SA": '#487FFF',
            "AU": '#487FFF',
            "CN": '#487FFF',
            "GB": '#487FFF',
          },
          attribute: 'fill'
        }]
      },
      hoverOpacity: null,
      normalizeFunction: 'linear',
      zoomOnScroll: false,
      scaleColors: ['#000000', '#000000'],
      selectedColor: '#000000',
      selectedRegions: [],
      enableZoom: false,
      hoverColor: '#fff',
    });
  // ================================ J Vector Map End ================================ 

  // ================================ Vertical bar chart js Start ================================ 
  var options = {
    series: [{
      data: [6200, 5200, 4200, 3200, 1200]
    }],
    chart: {
      type: 'bar',
      height: 270,
      toolbar: {
        show: false
      },
    },
    plotOptions: {
      bar: {
        borderRadius: 4,
        horizontal: true,
        distributed: true, // Enables individual bar styling
        barHeight: '22px'
      }
    },
    dataLabels: {
      enabled: false
    },
    grid: {
      show: true,
      borderColor: '#ddd',
      strokeDashArray: 0,
      position: 'back',
      xaxis: {
        lines: {
          show: false
        }
      },
      yaxis: {
        lines: {
          show: false
        }
      },
    },
    xaxis: {
      categories: ['Booking', 'Pending', 'Finished', 'Canceled', 'Refunded'],
      labels: {
        formatter: function (value) {
          return (value / 1000).toFixed(0) + 'k';
        }
      }
    },
    legend: {
      show: false
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'light',
        type: "horizontal",
        shadeIntensity: 0.5,
        gradientToColors: ['#C98BFF', '#FFDC90', '#94FF9B', '#FFAC89', '#A3E2FE'],
        inverseColors: false,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    colors: [
      '#8501F8',
      '#FF9F29',
      '#00D40E',
      '#F84B01',
      '#2FBCFC'
    ]
  };

  var chart = new ApexCharts(document.querySelector("#statisticBarChart"), options);
  chart.render();
  // ================================ Vertical bar chart js End ================================ 

  // ================================ Travel Card slider js Start ================================ 
  $('.travel-slider').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    speed: 1500,
    dots: false,
    pauseOnHover: true,
    arrows: true,
    draggable: true,
    rtl: $('html').attr('dir') === 'rtl' ? true : false,
    speed: 900,
    infinite: true,
    nextArrow: '#instructor-next',
    prevArrow: '#instructor-prev',
    responsive: [
      {
        breakpoint: 1299,
        settings: {
          slidesToShow: 3,
          arrows: false,
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          arrows: false,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 2,
          arrows: false,
        }
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          arrows: false,
        }
      },
    ]
  });
  // ========================= Travel Card slider Js End ===================

  // ================================ Animated Radial Progress Bar Start ================================ 
  $('svg.radial-progress').each(function (index, value) {
    $(this).find($('circle.complete')).removeAttr('style');
  });

  // Activate progress animation on scroll
  $(window).scroll(function () {
    $('svg.radial-progress').each(function (index, value) {
      // Trigger when the element is fully in the viewport
      if (
        $(window).scrollTop() >= $(this).offset().top - $(window).height() &&
        $(window).scrollTop() <= $(this).offset().top + $(this).height()
      ) {
        // Get percentage of progress
        const percent = $(value).data('percentage');
        // Get radius of the svg's circle.complete
        const radius = $(this).find($('circle.complete')).attr('r');
        // Get circumference (2πr)
        const circumference = 2 * Math.PI * radius;
        // Get stroke-dashoffset value based on the percentage of the circumference
        const strokeDashOffset = circumference - ((percent * circumference) / 100);
        // Transition progress for 1.25 seconds
        $(this).find($('circle.complete')).animate({ 'stroke-dashoffset': strokeDashOffset }, 1250);
      }
    });
  }).trigger('scroll');
  // ================================ Animated Radial Progress Bar End ================================ 

  // ===================== Average Enrollment Rate Start =============================== 
  function createChartTwo(chartId, color1, color2) {
    var options = {
      series: [{
        name: 'series1',
        data: [48, 35, 55, 32, 48, 30, 55, 50, 57]
      }, {
        name: 'series2',
        data: [12, 20, 15, 26, 22, 60, 40, 48, 25]
      }],
      legend: {
        show: false
      },
      chart: {
        type: 'area',
        width: '100%',
        height: 200,
        toolbar: {
          show: false
        },
        padding: {
          left: 0,
          right: 0,
          top: 0,
          bottom: 0
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'smooth',
        width: 3,
        colors: [color1, color2], // Use two colors for the lines
        lineCap: 'round'
      },
      grid: {
        show: true,
        borderColor: '#D1D5DB',
        strokeDashArray: 1,
        position: 'back',
        xaxis: {
          lines: {
            show: false
          }
        },
        yaxis: {
          lines: {
            show: true
          }
        },
        row: {
          colors: undefined,
          opacity: 0.5
        },
        column: {
          colors: undefined,
          opacity: 0.5
        },
        padding: {
          top: -20,
          right: 0,
          bottom: -10,
          left: 0
        },
      },
      fill: {
        type: 'gradient',
        colors: [color1, color2], // Use two colors for the gradient
        gradient: {
          shade: 'light',
          type: 'vertical',
          shadeIntensity: 0.5,
          gradientToColors: [undefined, `${color2}00`], // Apply transparency to both colors
          inverseColors: false,
          opacityFrom: [0, 0], // Starting opacity for both colors
          opacityTo: [0, 0], // Ending opacity for both colors
          stops: [0, 100],
        },
      },
      markers: {
        colors: [color1, color2], // Use two colors for the markers
        strokeWidth: 3,
        size: 0,
        hover: {
          size: 10
        }
      },
      xaxis: {
        labels: {
          show: false
        },
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        tooltip: {
          enabled: false
        },
        labels: {
          formatter: function (value) {
            return value;
          },
          style: {
            fontSize: "14px"
          }
        }
      },
      yaxis: {
        labels: {
          formatter: function (value) {
            return "$" + value + "k";
          },
          style: {
            fontSize: "14px"
          }
        },
      },
      tooltip: {
        x: {
          format: 'dd/MM/yy HH:mm'
        }
      }
    };

    var chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
    chart.render();
  }

  createChartTwo('enrollmentChart', '#487FFF', '#FF9F29');
  // ===================== Average Enrollment Rate End =============================== 

</script>
<script src="{{ asset('editor/ckeditor/ckeditor.js')}}"></script>
<script src="{{ asset('editor/ckeditor/adapters/jquery.js')}}"></script>

<script src="{{asset('assets_site/js/ckeditor.js')}}"></script>
<script src="{{asset('assets_site/js/ckeditor_config.js')}}"></script>
@stack('scripts')
</body>

<!-- Mirrored from wowdash.wowtheme7.com/demo/index-12.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 21 Mar 2025 14:59:14 GMT -->

</html>