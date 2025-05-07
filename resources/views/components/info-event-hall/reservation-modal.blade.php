@props(['eventHall'])
@php
 
@endphp
<!-- Main modal -->
<div

  id="default-modal"
  tabindex="-1"
  
  aria-hidden="true"
  class="hidden fixed inset-0 z-[2000] items-center justify-center overflow-y-auto overflow-x-hidden w-full h-[calc(100%-1rem)] md:inset-0 bg-black bg-opacity-50"
>
  <div class="relative w-full max-w-2xl max-h-full p-4">
    <!-- Modal content -->
    <div
    {{--   @click.away="showReservationModal = false" --}}
      class="flex flex-col rounded-lg shadow-xl max-h-[90vh] w-full bg-card text-card-foreground"
    >
      <!-- Modal header -->
      <div
        class="sticky top-0 flex items-center justify-between p-4 bg-white border-b border-gray-200 rounded-t-lg"
      >
        <h3 class="text-2xl font-semibold text-primary">
          Finaliser votre réservation
        </h3>
        <button type="button" class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 transition bg-transparent rounded-lg hover:border-[2px] hover:border-primary hover:text-primary ms-auto" data-modal-hide="default-modal">
            <i data-lucide="x"></i>
            <span class="sr-only">Close modal</span>
        </button>
      </div>

      <!-- Modal body (scrollable) -->
      <div class="flex-1 p-4 space-y-6 overflow-y-auto">
        <form
          id="bookingForm"
          action="{{ route('booking.create') }}"
          method="POST"
          class="space-y-6"
        >
          @csrf
          <input type="hidden" name="event_hall_id" value="{{ $eventHall->id }}">
          <input type="hidden" name="arrival_time" x-model="startDate">
          <input type="hidden" name="departure_time" x-model="endDate">
         {{--  <input type="hidden" name="price" value="{{ $eventHall->prix }}"> --}}

          <!-- Informations personnelles -->
          <div class="space-y-4">
            <!-- Nom complet -->
            <div>
              <label
                for="full_name"
                class="block mb-1 text-sm font-normal"
                >Nom complet</label
              >
              <input
                type="text"
                id="full_name"
                name="full_name"
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:ring-2 focus:border-primary focus:ring-offset-2"
              />
            </div>
         
              <!-- Email + Telephone -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- Email -->
                <div>
                    <label
                    for="email"
                    class="block mb-1 text-sm font-normal"
                    >Email</label
                    >
                    <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:ring-2 focus:border-primary focus:ring-offset-2"
                    />
                </div>
                <!-- Téléphone -->
                <div>
                    <label
                    for="phone"
                    class="block mb-1 text-sm font-normal"
                    >Téléphone</label
                    >
                    <input
                    type="tel"
                    id="phone"
                    name="phone"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:ring-2 focus:border-primary focus:ring-offset-2"
                    />
                </div>
            </div>
        
            <!-- Ville + Région -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                
                <!-- Adresse -->
                <div>
                    <label
                    for="address"
                    class="block mb-1 text-sm font-normal"
                    >Adresse</label
                    >
                    <input
                    type="text"
                    id="address"
                    name="address"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:ring-2 focus:border-primary focus:ring-offset-2"
                    />
                </div>
                <div>
                    <label
                    for="city"
                    class="block mb-1 text-sm font-normal"
                    >Ville</label
                    >
                    <input
                    type="text"
                    id="city"
                    name="city"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:ring-2 focus:border-primary focus:ring-offset-2"
                    />
                </div>
           
           
           
           
          </div>
               <!-- Message -->
               <div>
                <label
                  for="message"
                  class="block mb-1 text-sm font-normal"
                  >Message</label
                >
                <textarea
                  id="message"
                  name="message"
                  rows="4"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:ring-2 focus:border-primary focus:ring-offset-2"
                ></textarea>
              </div>
            </div>

          <!-- Récapitulatif de la réservation -->
          <div class="p-4 space-y-2 rounded-lg bg-secondary/40">
            <h4 class="text-lg font-semibold">Récapitulatif</h4>
            <div class="flex justify-between">
              <span class="">Salle</span>
              <span class="text-lg font-semibold text-muted-foreground">{{ $eventHall->nom_salle }}</span>
            </div>
            <div class="flex justify-between">
              <span class="">Dates</span>
              <span class="text-sm font-medium text-muted-foreground">
                <span x-text="formatDate(startDate)"></span> - <span x-text="formatDate(endDate)"></span>
              </span>
            </div>
            <div class="flex justify-between">
              <span class="">Durée</span>
              <span class="text-sm font-medium text-muted-foreground">
                <span x-text="calculateNights()"></span> jour<span x-show="calculateNights() > 1">s</span>
              </span>
            </div>
            <div class="flex justify-between pt-2 mt-2 border-t border-gray-200">
              <span class="">Sous-total</span>
              <span class="text-sm font-medium text-muted-foreground" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }})"></span>
            </div>
           {{--  <div class="flex justify-between">
              <span class="">Frais de service (10%)</span>
              <span class="text-sm font-medium text-muted-foreground" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }} * 0.1)"></span>
            </div> --}}
           {{--  <div class="flex justify-between pt-2 mt-2 font-bold border-t border-gray-200">
              <span>Total</span>
              <span class="text-lg font-bold text-primary" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }} * 1.1)"></span>
            </div> --}}
          </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div
        class="sticky bottom-0 flex flex-col items-center justify-between gap-4 p-4 space-y-3 bg-white border-t border-gray-200 rounded-b-lg md:flex-row md:space-y-0"
      >
        <p class="flex-[2] text-sm">
          En cliquant sur <span class='text-primary'>"Confirmer la réservation"</span>, vous acceptez les
          conditions générales et la politique d'annulation.
        </p>
        <button
          type="submit"
          form="bookingForm"
          class="flex-1 px-4 py-3 font-medium text-white transition-colors rounded-lg bg-primary hover:bg-primary/80"
        >
          Confirmer la réservation
        </button>
      </div>
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
        <h2 class="mb-2 text-2xl font-bold text-gray-900">Réservation en cours de traitement</h2>
        <p class="mb-6 text-gray-600">
            Merci pour votre demande de réservation. Un email de confirmation vous sera envoyé une fois que votre demande aura été traitée.
        </p>
        <button 
            @click="showConfirmationModal = false"
            class="w-full px-4 py-3 font-medium text-white transition-colors bg-indigo-600 rounded-lg hover:bg-indigo-700">
            Fermer
        </button>
    </div>
</div> 