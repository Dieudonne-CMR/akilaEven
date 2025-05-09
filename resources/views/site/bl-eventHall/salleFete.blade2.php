@extends('site.layouts.app-site2')

@section('content-site')
<!-- ================================
   START HERO AREA
================================= -->
<section class="hero-area">
    <div class="hero-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="text-center col-lg-12">
                    <div class="hero-content">
                        <div class="section-heading">
                            <h1 class="text-white hero__title">Salles de Fêtes</h1>
                            <p class="pt-3 text-white hero__desc">Découvrez les meilleures salles pour vos événements</p>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ================================
    END HERO AREA
================================= -->

<!-- ================================
    START EVENT HALLS AREA
================================= -->
<section class="card-area section--padding">
    <div class="container">
        <div class="row">
            <!-- Sidebar avec les filtres (version desktop) -->
            <div class="col-lg-3 d-none d-lg-block">
                @include('site.bl-eventHall.partials.event-hall-filters')
            </div>
            
            <!-- Zone de contenu principal avec la liste des salles -->
            <div class="col-lg-9">
                <!-- Filtres mobile et résultats -->
                <div class="mb-4 d-flex d-lg-none justify-content-between align-items-center mobile-filters">
                    <button type="button" class="btn btn-outline-primary filter-btn" data-bs-toggle="offcanvas" data-bs-target="#filtersOffcanvas">
                        <i class="la la-filter"></i> Filtres
                    </button>

                    @include('site.bl-eventHall.partials.event-hall-mobile-filters')
                </div>
                
                @include('site.bl-eventHall.partials.event-hall-listing')
            </div>
        </div>
    </div>
</section>
<!-- ================================
    END EVENT HALLS AREA
================================= -->

<!-- ================================
    START PROMOTION AREA
================================= -->
<section class="py-5 promotion-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center col-lg-8">
                <h2 class="mb-3 promotion-title">Vous êtes manager et vous souhaitez créer votre espace afin de promouvoir vos salles de fêtes et locations d'agence?</h2>
                <p class="mb-4 promotion-desc">Rejoignez des milliers de clients satisfaits et trouvez l'espace parfait dès aujourd'hui.</p>
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg create-space-btn">Créer votre espace</a>
            </div>
        </div>
    </div>
</section>
<!-- ================================
    END PROMOTION AREA
================================= -->

<!-- CSS supplémentaire pour cette page -->
<style>
    /* Hero image */
    .hero-area {
        background-image: url("{{ asset('assets_site/images_site/event_halls/event-halls-3.jpg') }}");
        background-size: cover;
        background-position: center;
        position: relative;
        height: 300px;
        display: flex;
        align-items: center;
    }
    
    .hero-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    .hero-content {
        position: relative;
        z-index: 10;
    }
    
    .hero__title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0;
    }
    
    .hero__desc {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Styles généraux de la page */
    .section--padding {
        padding: 60px 0;
    }
    
    /* Filtres mobile */
    .mobile-filters {
        margin-bottom: 20px;
    }
    
    .filter-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    
    /* Zone de promotion */
    .promotion-area {
        background-color: #287dfa;
        color: white;
    }
    
    .promotion-title {
        font-size: 1.8rem;
        font-weight: 600;
    }
    
    .promotion-desc {
        font-size: 1.1rem;
        opacity: 0.9;
    }
    
    .create-space-btn {
        background-color: white;
        color: #287dfa;
        border-radius: 4px;
        padding: 10px 25px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }
    
    .create-space-btn:hover {
        background-color: rgba(255, 255, 255, 0.9);
        color: #0056b3;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .hero__title {
            font-size: 2rem;
        }
        
        .hero__desc {
            font-size: 1rem;
        }
        
        .promotion-title {
            font-size: 1.5rem;
        }
    }
</style>

<!-- JavaScript pour initialiser les composants -->
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les sliders jQuery UI
        if ($.fn.slider) {
            $('.range-slider-ui').slider();
        }
        
        // Initialiser les accordéons
        $('.accordion-button').on('click', function() {
            $(this).toggleClass('collapsed');
            const target = $(this).data('bs-target');
            $(target).toggleClass('show');
        });
        
        // Initialiser les contrôles de carousel
        if (typeof owlCarousel !== 'undefined') {
            $('.event-hall-carousel').each(function() {
                const $carousel = $(this);
                const slideCount = $carousel.find('.item').length;
                
                // Ne pas initialiser le carrousel si une seule image
                if (slideCount <= 1) {
                    $carousel.find('.owl-nav').hide();
                    $carousel.find('.owl-dots').hide();
                    return;
                }
                
                $carousel.owlCarousel({
                    items: 1,
                    loop: slideCount > 1,
                    margin: 0,
                    nav: true,
                    dots: true,
                    autoplay: slideCount > 1,
                    autoplayTimeout: 5000,
                    navText: [
                        '<i class="la la-angle-left"></i>',
                        '<i class="la la-angle-right"></i>'
                    ]
                });
            });
        }
    });
</script>
@endpush
@endsection
