@props(['eventHall'])

<div class="w-full text-card-foreground lg:w-1/3">
    <div class="sticky top-8">
        <div class="max-w-sm p-6 border border-gray-200 rounded-lg shadow-sm bg-card">
            <h2 class="mb-4 text-2xl font-bold">Réservez cette salle</h2>
            
            <!-- Prix et dates -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="">Prix par jour</span>
                    <span class="text-xl font-semibold text-primary">{{ number_format($eventHall->prix, 0, ',', ' ') }} <span>FCFA</span></span>
                </div>
                
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <div class="flex justify-between mb-2">
                        <div>
                            <span class="">Dates</span>
                            <div x-show="!startDate && !endDate" class="text-sm text-muted-foreground">Sélectionnez vos dates</div>
                            <div x-show="startDate && endDate" class="text-sm font-medium">
                                <span class="text-sm text-muted-foreground" x-text="formatDate(startDate)"></span> - <span class="text-muted-foreground" x-text="formatDate(endDate)"></span>
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
                        <span class="">
                            <span x-text="calculateNights()"></span> jour<span x-show="calculateNights() > 1">s</span> x {{ number_format($eventHall->prix, 0, ',', ' ') }} <span>FCFA</span>
                        </span>
                        <span class="text-sm text-muted-foreground" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }})"></span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="t">Frais de service (10%)</span>
                        <span class="text-sm text-muted-foreground" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }} * 0.1)"></span>
                    </div>
                    <div class="flex justify-between pt-4 mt-4 text-lg font-bold border-t border-gray-200">
                        <span>Total</span>
                        <span class="text-xl font-bold text-primary" x-text="formatPrice(calculateNights() * {{ $eventHall->prix }} * 1.1)"></span>
                    </div>
                </div>
            </div>
            
            <!-- Bouton de réservation -->
            <button
                data-modal-target="default-modal" data-modal-toggle="default-modal"  
                {{-- @click="openReservationModal()" --}}
                :disabled="!startDate || !endDate"
                :class="{'bg-primary hover:bg-primary/80': startDate && endDate, 'bg-muted-foreground cursor-not-allowed': !startDate || !endDate}"
                class="w-full px-4 py-3 font-medium text-white transition-colors rounded-lg">
                Réserver maintenant
            </button>
            <!-- Modal toggle -->


<!-- Modal toggle -->
{{-- <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    Toggle modal
  </button> --}}
  
 
  
        </div>
    </div>
</div> 