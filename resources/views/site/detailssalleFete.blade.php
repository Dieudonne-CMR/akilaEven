@extends('site.layouts.app-site2')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<!-- Swiper pour le carrousel mobile -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <!-- Flatpickr pour le calendrier -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<style>
    [x-cloak] { display: none !important; }
    
    /* Style pour le calendrier */
    .flatpickr-calendar.inline {
        width: 100%;
        box-shadow: none;
        margin-top: 1rem;
    }
    
    /* Style pour le carrousel mobile */
    .swiper-pagination-bullet-active {
        background-color: white;
    }
    .event-hall-subtitle span:not(:last-child)::after {
            content: "|";
            margin-left: 5px;
        }
</style>
@section('content-site')

<!-- ================================
   START HALL DETAIL AREA
================================= -->
<div x-data="roomDetails()" class="container px-4 py-8 mx-auto max-w-7xl">
    <!-- Contenu principal -->
    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Section détails de la salle (partie gauche) -->
        <div class="w-full lg:w-2/3">
            <!-- En-tête avec titre et sous-titre -->
            <div class="flex flex-col justify-between gap-6 mb-6 md:flex-row md:items-end">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $eventHall->nom_salle }}</h1>
                    <div class="flex flex-wrap items-center gap-2 mt-2 text-sm event-hall-subtitle">
                        <span><i class="text-blue-500 fa-solid fa-hotel"></i> {{ $eventHall->hotel->nom_hotel ?? 'Hôtel non spécifié' }}</span>                       
                      {{--   <div data-orientation="vertical" role="none" class="shrink-0 bg-border w-[1px] h-4"></div> --}}
                        <span><i class="text-orange-500 fas fa-map-marker-alt"></i> {{ $eventHall->ville->nom ?? 'Ville non spécifiée' }}, {{ $eventHall->localisation ?? 'Localisation non spécifiée' }}</span>
                       
                        <span><i class="text-green-500 fas fa-users"></i>{{ number_format($eventHall->capacite) }} places</span>
                    </div>
                </div>
              
                <button 
                    @click="toggleCalendarView()"
                    class="py-3 mt-4 text-sm text-white transition-colors rounded-lg md:py-2 md:px-2 bg-primary md:mt-0 hover:bg-primary/80">
                    Voir disponibilités
                </button>
            </div>
            
            <!-- Calendrier inline (affiché/masqué) -->
            <div x-show="showCalendar" x-cloak class="p-4 mb-6 bg-white rounded-lg shadow-md">
                <h3 class="mb-2 text-lg font-semibold">Sélectionnez vos dates</h3>
                <div id="inline-calendar" class="w-full"></div>
                <div class="flex justify-end mt-4">
                    <button 
                        @click="applyDates()"
                        class="px-4 py-2 text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Appliquer
                    </button>
                </div>
            </div>
            
            <!-- Galerie d'images (desktop) -->
            <div class="hidden grid-cols-4 gap-2 mb-8 md:grid">
                @php
                    // Les champs d'images
                    $imageFields = ['photo', 'photo1', 'photo2', 'photo3', 'photo4'];
                    
                    // Filtrer pour ne garder que les champs d'images remplis
                    $images = collect($imageFields)->filter(function($field) use ($eventHall) {
                        return !empty($eventHall->$field);
                    });
                    
                    $imagesCount = $images->count();
                @endphp
                
                @if($imagesCount === 1)
                    <!-- Si seulement la photo principale est définie -->
                    <div class="col-span-4">
                        <img src="{{asset('storage/' . $eventHall->photo)}}" alt="{{ $eventHall->nom_salle }}" class="object-cover w-full h-full rounded-lg">
                    </div>
                @else
                    <!-- Si plusieurs photos sont définies -->
                    <div class="col-span-2 row-span-2">
                        <img src="{{asset('storage/' . $eventHall->photo)}}" alt="{{ $eventHall->nom_salle }}" class="object-cover w-full h-full rounded-lg">
                    </div>
                    @foreach($images->slice(1)->values() as $index => $image)
                        <div class="">
                            <img src="{{asset('storage/' . $eventHall->$image)}}" alt="{{ $eventHall->nom_salle }} - Vue {{ $index + 1 }}" class="object-cover w-full h-40 rounded-lg">
                        </div>
                    @endforeach
                @endif
            </div>
            
            <!-- Carrousel d'images (mobile) -->
            <div class="mb-8 md:hidden h-[250px]">
                <div class="overflow-hidden rounded-lg swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{asset('storage/' . $eventHall->photo)}}" alt="{{ $eventHall->nom_salle }}" class="object-cover w-full h-64">
                        </div>
                        <div class="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1498&q=80" alt="Espace cocktail" class="object-cover w-full h-64">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1498&q=80" alt="Espace dîner" class="object-cover w-full h-64">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1498&q=80" alt="Scène" class="object-cover w-full h-64">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1498&q=80" alt="Décoration" class="object-cover w-full h-64">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            
            <!-- Onglets interactifs -->
            <div class="mb-8">
                <div class="flex border-b border-gray-200">
                    <button 
                        @click="activeTab = 'description'" 
                        :class="{'border-b-2 border-indigo-600 text-indigo-600': activeTab === 'description', 'text-gray-500': activeTab !== 'description'}"
                        class="px-6 py-4 font-medium">
                        Description
                    </button>
                    <button 
                        @click="activeTab = 'equipements'" 
                        :class="{'border-b-2 border-indigo-600 text-indigo-600': activeTab === 'equipements', 'text-gray-500': activeTab !== 'equipements'}"
                        class="px-6 py-4 font-medium">
                        Équipements
                    </button>
                    <button 
                        @click="activeTab = 'reglement'" 
                        :class="{'border-b-2 border-indigo-600 text-indigo-600': activeTab === 'reglement', 'text-gray-500': activeTab !== 'reglement'}"
                        class="px-6 py-4 font-medium">
                        Règlement
                    </button>
                </div>
                
                <!-- Contenu des onglets -->
                <div class="py-6">
                    <!-- Description -->
                    <div x-show="activeTab === 'description'" class="space-y-4">
                        <p class="text-gray-700">
                            @if(!empty($eventHall->description))
                            <p>{{ $eventHall->description }}</p>
                        @else
                            Aucune description disponible pour cette salle
                        @endif
                        </p>
                       {{--  <p class="text-gray-700">
                            La salle principale offre un espace modulable de 300m² avec de hauts plafonds et de grandes fenêtres laissant entrer la lumière naturelle. Un espace cocktail séparé de 100m² est également disponible pour vos réceptions.
                        </p>
                        <p class="text-gray-700">
                            Notre équipe professionnelle est à votre disposition pour vous aider à organiser votre événement sur mesure et répondre à toutes vos exigences.
                        </p> --}}
                    </div>
                    
                    <!-- Équipements -->
                    <div x-show="activeTab === 'equipements'" class="space-y-4" x-cloak>
                        <ul class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Système de sonorisation professionnel
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Éclairage scénique
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Vidéoprojecteur et écran
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Wi-Fi haut débit
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Cuisine équipée pour traiteur
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Vestiaire
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Parking privé (30 places)
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Accès PMR
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Règlement -->
                    <div x-show="activeTab === 'reglement'" class="space-y-4" x-cloak>
                        <h3 class="text-lg font-semibold">Conditions de réservation</h3>
                        <ul class="pl-5 space-y-2 text-gray-700 list-disc">
                            <li>Acompte de 30% à la réservation, non remboursable</li>
                            <li>Solde à régler 30 jours avant l'événement</li>
                            <li>Caution de 2000€ (non encaissée) à déposer le jour de l'événement</li>
                            <li>Annulation gratuite jusqu'à 60 jours avant l'événement (hors acompte)</li>
                        </ul>
                        
                        <h3 class="mt-6 text-lg font-semibold">Horaires</h3>
                        <ul class="pl-5 space-y-2 text-gray-700 list-disc">
                            <li>Location de 8h à 2h du matin maximum</li>
                            <li>Installation possible dès 8h le jour de l'événement</li>
                            <li>Démontage à terminer avant 10h le lendemain</li>
                        </ul>
                        
                        <h3 class="mt-6 text-lg font-semibold">Restrictions</h3>
                        <ul class="pl-5 space-y-2 text-gray-700 list-disc">
                            <li>Musique à volume modéré après minuit</li>
                            <li>Interdiction de fumer à l'intérieur</li>
                            <li>Confettis et paillettes interdits</li>
                            <li>Animaux non admis (sauf chiens guides)</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Carte Google Maps -->
            <div class="mb-8">
                <h3 class="mb-4 text-xl font-semibold">Localisation</h3>
                <div class="w-full overflow-hidden rounded-lg h-80">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9916256937604!2d2.292292615509614!3d48.85837007928746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e2964e34e2d%3A0x8ddca9ee380ef7e0!2sTour%20Eiffel!5e0!3m2!1sfr!2sfr!4v1651245814268!5m2!1sfr!2sfr" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        
        <!-- Section tarification (partie droite) -->
        <div class="w-full text-black lg:w-1/3">
            <div class="sticky top-8">
                <div class="p-6 border border-gray-200 rounded-lg shadow-md bg-card">
                    <h2 class="mb-4 text-2xl font-bold text-black">Réservez cette salle</h2>
                    
                    <!-- Prix et dates -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="">Prix par jour</span>
                            <span class="text-xl font-semibold text-primary">{{ number_format($eventHall->prix, 0, ',', ' ') }} <span>FCFA</span></span>
                        </div>
                        
                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <div class="flex justify-between mb-2">
                                <div>
                                    <span class="text-black">Dates</span>
                                    <div x-show="!startDate && !endDate" class="text-sm text-muted-foreground">Sélectionnez vos dates</div>
                                    <div x-show="startDate && endDate" class="text-sm font-medium">
                                        <span x-text="formatDate(startDate)"></span> - <span x-text="formatDate(endDate)"></span>
                                    </div>
                                </div>
                                <button 
                                    @click="toggleCalendarView()"
                                    class="text-sm text-muted-foreground">
                                    Modifier
                                </button>
                            </div>
                        </div>
                        
                        <!-- Calcul du prix -->
                        <div x-show="startDate && endDate" class="pt-4 mt-4 border-t border-gray-200">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-700">
                                    <span x-text="calculateNights()"></span> jour<span x-show="calculateNights() > 1">s</span> x {{ number_format($eventHall->prix, 0, ',', ' ') }} <span>FCFA</span>
                                </span>
                                <span class="font-semibold text-primary" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }})"></span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="t">Frais de service (10%)</span>
                                <span class="font-semibold text-primary" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }} * 0.1)"></span>
                            </div>
                            <div class="flex justify-between pt-4 mt-4 text-lg font-bold border-t border-gray-200">
                                <span>Total</span>
                                <span class="text-xl text-primary" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }} * 1.1)"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bouton de réservation -->
                    <button 
                        @click="openReservationModal()"
                        :disabled="!startDate || !endDate"
                        :class="{'bg-primary hover:bg-primary/80': startDate && endDate, 'bg-muted-foreground cursor-not-allowed': !startDate || !endDate}"
                        class="w-full px-4 py-3 font-medium text-white transition-colors rounded-lg">
                        Réserver maintenant
                    </button>
                   
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modale de réservation -->
    <div 
        x-show="showReservationModal" 
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div 
            @click.away="showReservationModal = false"
            class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Finaliser votre réservation</h2>
                    <button @click="showReservationModal = false" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <form @submit.prevent="submitReservation()" class="space-y-6">
                    <!-- Informations personnelles -->
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block mb-1 text-sm font-medium text-gray-700">Nom complet</label>
                            <input 
                                type="text" 
                                id="name" 
                                x-model="form.name" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                            <input 
                                type="email" 
                                id="email" 
                                x-model="form.email" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">Téléphone</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                x-model="form.phone" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                        </div>
                        <div>
                            <label for="message" class="block mb-1 text-sm font-medium text-gray-700">Message (optionnel)</label>
                            <textarea 
                                id="message" 
                                x-model="form.message" 
                                rows="3" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        </div>
                    </div>
                    
                    <!-- Récapitulatif de la réservation -->
                    <div class="p-4 rounded-lg bg-gray-50">
                        <h3 class="mb-3 text-lg font-semibold">Récapitulatif</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Salle</span>
                                <span class="font-medium">Le Grand Palais</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Dates</span>
                                <span class="font-medium">
                                    <span x-text="formatDate(startDate)"></span> - <span x-text="formatDate(endDate)"></span>
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Durée</span>
                                <span class="font-medium">
                                    <span x-text="calculateNights()"></span> jour<span x-show="calculateNights() > 1">s</span>
                                </span>
                            </div>
                            <div class="flex justify-between pt-2 mt-2 border-t border-gray-200">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-medium" x-text="formatPrice(calculateNights() * 2500)"></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Frais de service (10%)</span>
                                <span class="font-medium" x-text="formatPrice(calculateNights() * 2500 * 0.1)"></span>
                            </div>
                            <div class="flex justify-between pt-2 mt-2 font-bold border-t border-gray-200">
                                <span>Total</span>
                                <span x-text="formatPrice(calculateNights() * 2500 * 1.1)"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Conditions et politique d'annulation -->
                    <div class="text-sm text-gray-600">
                        <p class="mb-2">En cliquant sur "Confirmer la réservation", vous acceptez les conditions générales et la politique d'annulation.</p>
                        <p>Un acompte de 30% (<span x-text="formatPrice(calculateNights() * 2500 * 1.1 * 0.3)"></span>) sera prélevé immédiatement pour confirmer votre ré  * 2500 * 1.1 * 0.3)"></span>) sera prélevé immédiatement pour confirmer votre réservation.</p>
                    </div>
                    
                    <!-- Bouton de confirmation -->
                    <button 
                        type="submit"
                        class="w-full px-4 py-3 font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Confirmer la réservation
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modale de confirmation -->
    <div 
        x-show="showConfirmationModal" 
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="w-full max-w-md p-6 text-center bg-white rounded-lg shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <h2 class="mb-2 text-2xl font-bold text-gray-900">Réservation confirmée !</h2>
            <p class="mb-6 text-gray-600">
                Merci pour votre réservation. Un email de confirmation a été envoyé à <span x-text="form.email"></span>.
            </p>
            <button 
                @click="showConfirmationModal = false"
                class="w-full px-4 py-3 font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
                Fermer
            </button>
        </div>
    </div>
</div>

<script>
    // Initialisation du carrousel pour mobile
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
        });
    });
    
    // Fonction principale Alpine.js
    function roomDetails() {
        return {
            // Variables d'état
            activeTab: 'description',
            showCalendar: false,
            showReservationModal: false,
            showConfirmationModal: false,
            startDate: null,
            endDate: null,
            calendar: null,
            form: {
                name: '',
                email: '',
                phone: '',
                message: ''
            },
            
            // Initialisation
            init() {
                this.$nextTick(() => {
                    this.initCalendar();
                });
            },
            
            // Initialisation du calendrier Flatpickr
            initCalendar() {
                this.calendar = flatpickr("#inline-calendar", {
                    inline: true,
                    mode: "range",
                    minDate: "today",
                    locale: "fr",
                    dateFormat: "Y-m-d",
                    disable: [
                        // Dates déjà réservées (exemple)
                        "2023-12-24", "2023-12-25", "2023-12-31", "2024-01-01"
                    ],
                    onChange: (selectedDates) => {
                        if (selectedDates.length === 2) {
                            this.startDate = selectedDates[0];
                            this.endDate = selectedDates[1];
                        }
                    }
                });
            },
            
            // Afficher/masquer le calendrier
            toggleCalendarView() {
                this.showCalendar = !this.showCalendar;
            },
            
            // Appliquer les dates sélectionnées
            applyDates() {
                this.showCalendar = false;
            },
            
            // Calculer le nombre de nuits
            calculateNights() {
                if (!this.startDate || !this.endDate) return 0;
                
                const start = new Date(this.startDate);
                const end = new Date(this.endDate);
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // +1 car on compte le jour d'arrivée
                
                return diffDays;
            },
            
            // Formater le prix
            formatPrice(price) {
                return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XAF' }).format(price);
            },
            
            // Formater la date
            formatDate(date) {
                if (!date) return '';
                return new Intl.DateTimeFormat('fr-FR', { day: 'numeric', month: 'short', year: 'numeric' }).format(new Date(date));
            },
            
            // Ouvrir la modale de réservation
            openReservationModal() {
                if (this.startDate && this.endDate) {
                    this.showReservationModal = true;
                }
            },
            
            // Soumettre la réservation
            submitReservation() {
                // Ici, vous pourriez envoyer les données à votre backend
                console.log('Réservation soumise:', {
                    dates: {
                        start: this.startDate,
                        end: this.endDate,
                        nights: this.calculateNights()
                    },
                    total: this.calculateNights() * 2500 * 1.1,
                    user: this.form
                });
                
                // Fermer la modale de réservation et afficher la confirmation
                this.showReservationModal = false;
                this.showConfirmationModal = true;
            }
        };
    }
</script>

@endsection
