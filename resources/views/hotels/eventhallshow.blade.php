@extends('layouts.apps')
@section('content')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Detail de la salle </h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Details salle</li>
            </ul>
        </div>

        <div class="row gy-4">
            <div class="col-lg-12" >
                <div class="card p-0 radius-12 overflow-hidden">
                    <div class="card-body p-0">
                            <div class="row mb-4">
                                {{-- @foreach(['photo', 'photo1', 'photo2', 'photo3', 'photo4'] as $photo)
                                    @if($eventHall->$photo)
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ asset('storage/' . $eventHall->$photo) }}" target="_blank">
                                                
                                                <img src="{{ asset('storage/' . $eventHall->$photo) }}" alt="Photo de la salle" class="w-100 h-100 object-fit-cover  img-fluid rounded">
                                            </a>
                                        </div>
                                    @endif
                                @endforeach --}}



                                <div class="col-sm-12">
                                    <div class="card p-0 overflow-hidden position-relative radius-12">
                                        <div class="card-header py-16 px-24 bg-base border border-end-0 border-start-0 border-top-0">
                                            <h6 class="text-lg mb-0">Carousel with progress</h6>
                                        </div>
                                        <div class="card-body p-0 position-relative">
                                            <div class="p-0 progress-carousel dots-style-circle dots-positioned">
                                                @foreach(['photo', 'photo1', 'photo2', 'photo3', 'photo4'] as $keys=> $photo)
                                                    @if($eventHall->$photo)
                                                    <div class="gradient-overlay bottom-0 start-0 h-100 <?= $keys==0 ?'position-relative':'' ?> ">
                                                        <a href="{{ asset('storage/' . $eventHall->$photo) }}">
                                                            <img src="{{ asset('storage/' . $eventHall->$photo) }}" alt="" class="w-100 h-100 object-fit-cover">
                                                        </a>
                                                
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="slider-progress">
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        <div class="p-32">
                            <div class="d-flex align-items-center gap-16 justify-content-between flex-wrap mb-24">
                                <div class="d-flex align-items-center gap-8">
                                    <img src="{{asset('storage/'.$eventHall->hotel->logo)}}" alt=""
                                        class="w-48-px h-48-px rounded-circle object-fit-cover">
                                        
                                    <div class="d-flex flex-column">
                                        <h6 class="text-lg mb-0"> Hôtel : {{ $eventHall->hotel->nom_hotel }}</h6>
                                        <small class="text-muted text-neutral-500">
                                            Ville : {{ $eventHall->ville->nom }}
                                        </small>
                                        {{-- <span class="text-sm text-neutral-500">1 day ago</span> --}}
                                    </div>
                                </div>
                                
                            </div>
                            <h3 class="mb-16">{{ $eventHall->nom_salle }} </h3>
                            <div class="card-body">
                                <h4 class="card-title gap-8 ">Caractéristiques</h4>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex  gap-8 text-neutral-500 text-lg fw-medium justify-content-between align-items-center">
                                        Capacité
                                        <span class="badge bg-primary rounded-pill">
                                            {{ $eventHall->capacite }} personnes
                                        </span>
                                    </li>
                                    <li class="list-group-item d-flex  gap-8 text-neutral-500 text-lg fw-medium justify-content-between align-items-center">
                                        Prix journalier
                                        <span class="text-success">
                                            {{ number_format($eventHall->prix, 2, ',', ' ') }} €
                                        </span>
                                    </li>
                                    <li class="list-group-item gap-8 text-neutral-500 text-lg fw-medium">
                                        <i class="fas fa-map-marker-alt"></i> 
                                        {{ $eventHall->localisation }}
                                    </li>
                                    <li class="list-group-item d-flex  gap-8 text-neutral-500 text-lg fw-medium justify-content-between align-items-center">
                                        Localisation
                                        <span class="text-success">
                                             {{ $eventHall->ville->nom }}, {{ $eventHall->localisation }}
                                        </span>
                                    </li>
                                </ul>

                                <div class="d-flex col-2 align-items-center flex-wrap mt-12 gap-8">
                                    <a href="{{route('event-halls.edit', $eventHall->id)}}"
                                        class="btn rounded-pill border text-neutral-500 border-neutral-500 radius-8 px-12 py-6 bg-hover-neutral-500 text-hover-white flex-grow-1">Edit</a>
                                </div>
                            </div>

                            

                            <p class="text-neutral-500 mb-16"> {{ $eventHall->description_salle }}</p>
                        </div>
                    </div>
                </div>
               
            </div>

            <!-- Sidebar Start -->
            {{-- <div class="col-lg-4">
                <div class="d-flex flex-column gap-24">

                    <!-- Search -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h6 class="text-xl mb-0">Search Here</h6>
                        </div>
                        <div class="card-body p-24">
                            <form class="position-relative">
                                <input type="text"
                                    class="form-control border border-neutral-200 radius-8 ps-40" name="search"
                                    placeholder="Search">
                                <iconify-icon icon="ion:search-outline"
                                    class="icon position-absolute positioned-icon top-50 translate-middle-y"></iconify-icon>
                            </form>
                        </div>
                    </div>

                    <!-- Latest Blog -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h6 class="text-xl mb-0">Latest Posts</h6>
                        </div>
                        <div class="card-body d-flex flex-column gap-24 p-24">
                            <div class="d-flex flex-wrap">
                                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                                    <img src="assets/images/blog/blog5.png" alt=""
                                        class="w-100 h-100 object-fit-cover">
                                </a>
                                <div class="blog__content">
                                    <h6 class="mb-8">
                                        <a href="blog-details.html"
                                            class="text-line-2 text-hover-primary-600 text-md transition-2">How to
                                            hire a right business executive for your company</a>
                                    </h6>
                                    <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga
                                        necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                                    <img src="assets/images/blog/blog6.png" alt=""
                                        class="w-100 h-100 object-fit-cover">
                                </a>
                                <div class="blog__content">
                                    <h6 class="mb-8">
                                        <a href="blog-details.html"
                                            class="text-line-2 text-hover-primary-600 text-md transition-2">The Gig
                                            Economy: Adapting to a Flexible Workforce</a>
                                    </h6>
                                    <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga
                                        necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                                    <img src="assets/images/blog/blog7.png" alt=""
                                        class="w-100 h-100 object-fit-cover">
                                </a>
                                <div class="blog__content">
                                    <h6 class="mb-8">
                                        <a href="blog-details.html"
                                            class="text-line-2 text-hover-primary-600 text-md transition-2">The
                                            Future of Remote Work: Strategies for Success</a>
                                    </h6>
                                    <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga
                                        necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <a href="blog-details.html" class="blog__thumb w-100 radius-12 overflow-hidden">
                                    <img src="assets/images/blog/blog6.png" alt=""
                                        class="w-100 h-100 object-fit-cover">
                                </a>
                                <div class="blog__content">
                                    <h6 class="mb-8">
                                        <a href="blog-details.html"
                                            class="text-line-2 text-hover-primary-600 text-md transition-2">Lorem
                                            ipsum dolor sit amet consectetur adipisicing.</a>
                                    </h6>
                                    <p class="text-line-2 text-sm text-neutral-500 mb-0">Lorem ipsum dolor sit amet
                                        consectetur adipisicing elit. Omnis dolores explicabo corrupti, fuga
                                        necessitatibus fugiat adipisci quidem eveniet enim minus.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h6 class="text-xl mb-0">Tags</h6>
                        </div>
                        <div class="card-body p-24">
                            <ul>
                                <li
                                    class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                    <a href="blog.html" class="text-hover-primary-600 transition-2"> Techbology
                                    </a>
                                    <span
                                        class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold">
                                        01 </span>
                                </li>
                                <li
                                    class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                    <a href="blog.html" class="text-hover-primary-600 transition-2"> Business </a>
                                    <span
                                        class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold">
                                        01 </span>
                                </li>
                                <li
                                    class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                    <a href="blog.html" class="text-hover-primary-600 transition-2"> Consulting
                                    </a>
                                    <span
                                        class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold">
                                        01 </span>
                                </li>
                                <li
                                    class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8 border-bottom border-dashed pb-12 mb-12">
                                    <a href="blog.html" class="text-hover-primary-600 transition-2"> Course </a>
                                    <span
                                        class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold">
                                        01 </span>
                                </li>
                                <li
                                    class="w-100 d-flex align-items-center justify-content-between flex-wrap gap-8">
                                    <a href="blog.html" class="text-hover-primary-600 transition-2"> Real Estate
                                    </a>
                                    <span
                                        class="text-neutral-500 w-28-px h-28-px rounded-circle bg-neutral-100 d-flex justify-content-center align-items-center transition-2 text-xs fw-semibold">
                                        01 </span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h6 class="text-xl mb-0">Tags</h6>
                        </div>
                        <div class="card-body p-24">
                            <div class="d-flex align-items-center flex-wrap gap-8">
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Development </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Design </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Technology </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Popular </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Codignator </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Javascript </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    Bootstrap </a>
                                <a href="blog.html"
                                    class="btn btn-sm btn-primary-600 bg-primary-50 bg-hover-primary-600 text-primary-600 border-0 d-inline-flex align-items-center gap-1 text-sm px-16 py-6">
                                    PHP </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var rtlDirection = $('html').attr('dir') === 'rtl';
  // ================================ Default Slider Start ================================ 
  $('.default-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1, 
        arrows: false, 
        dots: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        rtl: rtlDirection
    });

    // Arrow Carousel
  $('.arrow-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1, 
        arrows: true, 
        dots: false,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        prevArrow: '<button type="button" class="slick-prev"><iconify-icon icon="ic:outline-keyboard-arrow-left" class="menu-icon"></iconify-icon></button>',
        nextArrow: '<button type="button" class="slick-next"><iconify-icon icon="ic:outline-keyboard-arrow-right" class="menu-icon"></iconify-icon></button>',
        rtl: rtlDirection
    });

    // pagination carousel
    $('.pagination-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1, 
        arrows: false, 
        dots: true,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        prevArrow: '<button type="button" class="slick-prev"><iconify-icon icon="ic:outline-keyboard-arrow-left" class="menu-icon"></iconify-icon></button>',
        nextArrow: '<button type="button" class="slick-next"><iconify-icon icon="ic:outline-keyboard-arrow-right" class="menu-icon"></iconify-icon></button>',
        rtl: rtlDirection
    });
    
    // multiple carousel
    $('.multiple-carousel').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1, 
        arrows: false, 
        dots: true,
        infinite: true,
        autoplay: false,
        autoplaySpeed: 2000,
        speed: 600,
        gap: 24,
        prevArrow: '<button type="button" class="slick-prev"><iconify-icon icon="ic:outline-keyboard-arrow-left" class="menu-icon"></iconify-icon></button>',
        nextArrow: '<button type="button" class="slick-next"><iconify-icon icon="ic:outline-keyboard-arrow-right" class="menu-icon"></iconify-icon></button>',
        rtl: rtlDirection,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                slidesToShow: 3,
                }
            },
            {
                breakpoint: 991,
                settings: {
                slidesToShow: 2,
                }
            },
            {
                breakpoint: 575,
                settings: {
                slidesToShow: 1,
                }
            },
        ]
    });

    // carousel with progress bar
    jQuery(document).ready(function($) {
        var sliderTimer = 5000;
        var beforeEnd = 500;
        var $imageSlider = $('.progress-carousel');
        $imageSlider.slick({
            autoplay: true,
            autoplaySpeed: sliderTimer,
            speed: 1000,
            arrows: false,
            dots: false,
            adaptiveHeight: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            rtl: rtlDirection
        });

        function progressBar(){
            $('.slider-progress').find('span').removeAttr('style');
            $('.slider-progress').find('span').removeClass('active');
            setTimeout(function(){
                $('.slider-progress').find('span').css('transition-duration', (sliderTimer/1000)+'s').addClass('active');
            }, 100);
        }
        progressBar();
        $imageSlider.on('beforeChange', function(e, slick) {
            progressBar();
        });
        $imageSlider.on('afterChange', function(e, slick, nextSlide) {
            titleAnim(nextSlide);
        });

        // Title Animation JS
        function titleAnim(ele){
            $imageSlider.find('.slick-current').find('h1').addClass('show');
            setTimeout(function(){
                $imageSlider.find('.slick-current').find('h1').removeClass('show');
            }, sliderTimer - beforeEnd);
        }
        titleAnim();
    });
  // ================================ Default Slider End ================================ 
</script>
    
@endpush


