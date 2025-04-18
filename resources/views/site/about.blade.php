@extends('site.layouts.app-site')
@section('content-site')

<!-- Header Section -->
<section class="breadcrumb-area bread-bg-7">
    <div class="breadcrumb-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="sec__title text-white">À Propos de Nous</h2>
                            <p class="sec__desc text-white pt-3">Contactez-nous pour toutes vos questions ou réservations.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="breadcrumb-list text-right">
                        <ul class="list-items">
                            <li><a href="{{ route('home') }}">Accueil</a></li>
                            <li>À Propos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="contact-area padding-top-100px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center mb-5">
                    <h2 class="sec__title">Notre Plateforme de Réservation</h2>
                    <p class="sec__desc pt-3">
                        Bienvenue sur notre plateforme de réservation d'hôtels et de salles de fêtes. 
                        Nous vous proposons une large sélection d'hébergements et d'espaces pour vos événements.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- About Us Content -->
        <div class="row padding-bottom-50px">
            <div class="col-lg-6">
                <div class="about-content mb-4">
                    <h3 class="mb-3">Notre Mission</h3>
                    <p class="mb-3">
                        Notre mission est de faciliter la réservation d'hôtels et de salles de fêtes pour tous vos besoins, 
                        qu'il s'agisse d'un séjour d'affaires, de vacances en famille ou d'un événement spécial comme un mariage.
                    </p>
                    <p>
                        Nous collaborons avec les meilleurs établissements pour vous offrir un service de qualité 
                        et une expérience de réservation simple et agréable.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="image-box">
                    <img src="{{ asset('assets_site/images/img13.jpg') }}" alt="À propos de nous" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-area padding-bottom-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title">Nous Contacter</h3>
                        <p class="font-size-15 pt-2">Envoyez-nous un message et nous vous répondrons dans les plus brefs délais</p>
                    </div>
                    <div class="form-content">
                        <x-contact-form />
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-box">
                    <div class="form-title-wrap">
                        <h3 class="title">Coordonnées</h3>
                        <p class="font-size-15 pt-2">Retrouvez-nous facilement</p>
                    </div>
                    <div class="form-content">
                        <x-contact-info />
                    </div>
                </div>
                
                <div class="form-box mt-4">
                    <div class="form-title-wrap">
                        <h3 class="title">Réseaux Sociaux</h3>
                        <p class="font-size-15 pt-2">Suivez-nous pour ne rien manquer</p>
                    </div>
                    <div class="form-content">
                        <x-social-media :centered="true" :size="'large'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-area padding-bottom-100px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="map-container">
                    <div class="form-title-wrap">
                        <h3 class="title">Notre Emplacement</h3>
                        <p class="font-size-15 pt-2">Venez nous rencontrer directement à nos bureaux</p>
                    </div>
                    <div class="map-content mt-4">
                        <x-google-map height="500px" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<x-cta-section />

@endsection
