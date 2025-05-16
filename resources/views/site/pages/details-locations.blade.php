@extends('site.layouts.layout-site')

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
    .location-subtitle span:not(:last-child)::after {
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

<!-- ================================
   START LOCATION DETAIL AREA
================================= -->
<div x-data="locationDetails()" class="container px-4 py-8 mx-auto max-w-7xl">
    <!-- Contenu principal -->
    <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Section détails de la location (partie gauche) -->
        <x-site.locations.details.content-section :location="$location" />
        
        <!-- Section tarification (partie droite) -->
       {{--  <x-site.locations.details.pricing-section :location="$location" /> --}}
    </div>
    
    <!-- Modale de réservation -->
    <x-site.locations.details.reservation-modal :location="$location" />
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
    function locationDetails() {
        return {
            // Variables d'état
            activeTab: 'description',
            showCalendar: false,
            showReservationModal: false,
            showConfirmationModal: false,
            startDate: null,
            endDate: null,
            calendar: null,
            isRental: {{ $location->type_logement === 'meublé' ? 'true' : 'false' }},
            
            // Initialisation
            init() {
                this.$nextTick(() => {
                    if (this.isRental) {
                        this.initCalendar();
                    }
                    
                    // Écouteurs pour la modale
                    document.querySelectorAll('[data-modal-toggle="default-modal"]').forEach(button => {
                        button.addEventListener('click', () => {
                            if (!this.isRental || (this.isRental && this.startDate && this.endDate)) {
                                this.showReservationModal = true;
                                document.getElementById('default-modal').classList.remove('hidden');
                                document.getElementById('default-modal').classList.add('flex');
                            }
                        });
                    });
                    
                    // Écouteurs pour fermer la modale
                    document.querySelectorAll('[data-modal-hide="default-modal"]').forEach(button => {
                        button.addEventListener('click', () => {
                            this.showReservationModal = false;
                            document.getElementById('default-modal').classList.add('hidden');
                            document.getElementById('default-modal').classList.remove('flex');
                        });
                    });
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
                        // Ces dates devraient être dynamiquement chargées depuis le serveur
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
                if (this.isRental) {
                    this.showCalendar = !this.showCalendar;
                } else {
                    // Pour les non-meublés, ouvrir directement la modale
                    this.showReservationModal = true;
                    document.getElementById('default-modal').classList.remove('hidden');
                    document.getElementById('default-modal').classList.add('flex');
                }
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
                if (!this.isRental || (this.isRental && this.startDate && this.endDate)) {
                    this.showReservationModal = true;
                    document.getElementById('default-modal').classList.remove('hidden');
                    document.getElementById('default-modal').classList.add('flex');
                }
            }
        };
    }
</script>

@endsection
