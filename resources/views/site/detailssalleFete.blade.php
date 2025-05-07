@extends('site.layouts.app-site2')

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

<!-- Messages de feedback -->
@if(session('success'))
    <x-ui.toast type="success" message="{{ session('success') }}" position="bottom-right" />
@endif

@if(session('error'))
    <x-ui.toast type="error" message="{{ session('error') }}" position="bottom-right" />
@endif

@if($errors->any())
    <x-ui.toast type="error" message="{{ $errors->first() }}" position="bottom-right" />
@endif

<!-- ================================
   START HALL DETAIL AREA
================================= -->
<div x-data="roomDetails()" class="container px-4 py-8 mx-auto max-w-7xl">
    <!-- Contenu principal -->
    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Section détails de la salle (partie gauche) -->
        <div class="order-2 w-full lg:order-1 lg:w-2/3">
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
                        class="px-4 py-2 text-white transition-colors rounded-lg bg-primary hover:bg-primary/80">
                        Appliquer
                    </button>
                </div>
            </div>
            
            <!-- Galerie d'images (desktop) -->
            @php
    // Les champs d'images
    $imageFields = ['photo','photo1','photo2','photo3','photo4'];
    $images      = collect($imageFields)
                     ->filter(fn($f) => !empty($eventHall->$f))
                     ->values();
    $imagesCount = $images->count();
@endphp

@if($imagesCount === 1)
    {{-- Disposition pour 1 seule image --}}
    <div class="hidden gap-2 mb-8 md:grid md:grid-cols-4 md:grid-rows-2">
        <div class="col-span-4 row-span-2 aspect-video">
            <img
                src="{{ asset('storage/' . $eventHall->photo) }}"
                alt="{{ $eventHall->nom_salle }}"
                class="object-cover w-full h-full rounded-lg"
            >
        </div>
    </div>
@else
    {{-- Disposition pour plusieurs images --}}
    <div class="hidden gap-2 mb-8 md:grid md:grid-cols-4 md:grid-rows-2 max-h-[300px]">
        {{-- Image principale en 2:1 --}}
        <div class="col-span-2 row-span-2 aspect-w-2 aspect-h-1">
            <img
                src="{{ asset('storage/' . $eventHall->photo) }}"
                alt="{{ $eventHall->nom_salle }}"
                class="object-cover w-full h-full rounded-lg"
            >
        </div>

        {{-- Miniatures carrées --}}
        @foreach($images->slice(1) as $idx => $field)
            <div class="aspect-square">
                <img
                    src="{{ asset('storage/' . $eventHall->$field) }}"
                    alt="{{ $eventHall->nom_salle }} – Vue {{ $idx + 1 }}"
                    class="object-cover w-full h-full rounded-lg"
                >
            </div>
        @endforeach
    </div>
@endif
            
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
            <x-info-event-hall.tabs :eventHall="$eventHall" />
            
            <!-- Carte Google Maps -->
            <x-info-event-hall.map :eventHall="$eventHall" />
        </div>
        
        <!-- Section tarification (partie droite) -->
        <x-info-event-hall.pricing-section :eventHall="$eventHall" />
    </div>
    
    <!-- Modale de réservation -->
    <x-info-event-hall.reservation-modal :eventHall="$eventHall"  />
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
            price: null,
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
            }
        };
    }
</script>

@endsection
