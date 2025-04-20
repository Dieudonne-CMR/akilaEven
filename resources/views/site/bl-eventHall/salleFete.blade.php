@extends('site.layouts.app-site')

@section('content-site')
<!-- ================================
   START BREADCRUMB AREA
================================= -->
<section class="breadcrumb-area bread-bg">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="text-white sec__title">Salles de Fêtes</h2>
                            <p class="pt-3 text-white sec__desc">Découvrez les meilleures salles pour vos événements</p>
                        </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
</section>
<!-- ================================
    END BREADCRUMB AREA
================================= -->

<!-- ================================
    START EVENT HALLS AREA
================================= -->
<section class="card-area section--padding">
    <div class="container">
        <div class="row">
            <!-- Sidebar avec les filtres -->
            <div class="col-lg-3">
                @include('site.bl-eventHall.partials.filters')
            </div>
            
            <!-- Zone de contenu principal avec la liste des salles -->
            <div class="col-lg-9">
                @include('site.bl-eventHall.partials.listing')
            </div>
        </div>
    </div>
</section>
<!-- ================================
    END EVENT HALLS AREA
================================= -->

<!-- CSS supplémentaire pour cette page -->
<style>
    /* Hero image */
    .bread-bg {
        background-image: url("{{ asset('assets_site/images_site/event_halls/event-halls-3.jpg') }}");
        background-size: cover;
        background-position: center;
        position: relative;
    }
    
    .bread-bg::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }
    
    /* Styles généraux de la page */
    .section--padding {
        padding: 80px 0;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .col-lg-3 {
            margin-bottom: 30px;
        }
    }
</style>

<!-- JavaScript pour initialiser le carrousel -->
@push('scripts')
<script>
    // Initialiser les composants de la page une fois le DOM chargé
    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser les sliders jQuery UI si nécessaires
        if ($.fn.slider) {
            $('.range-slider-ui').slider();
        }
    });
</script>
@endpush
@endsection
