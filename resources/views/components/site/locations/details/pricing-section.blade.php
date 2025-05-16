@props(['location'])

@php
    // Déterminer le libellé de tarification
    $pricingLabel = $location->type_logement === 'meublé' ? '/jour' : '/mois';
@endphp

<div class="w-full text-card-foreground lg:w-1/3">
    <div class="sticky top-8">
        <div class="max-w-sm p-6 border border-gray-200 rounded-lg shadow-sm bg-card">
            <h2 class="mb-4 text-2xl font-bold">Réservez cette location</h2>
            
            <!-- Prix et dates -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="">Prix {{ $location->type_logement === 'meublé' ? 'par jour' : 'mensuel' }}</span>
                    <span class="text-xl font-semibold text-primary">{{ number_format($location->prix, 0, ',', ' ') }} <span>FCFA</span></span>
                </div>
                
                @if($location->type_logement === 'meublé')
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
                    
                    <div x-show="startDate && endDate" class="pt-4 mt-4 border-t border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span class="">
                                <span x-text="calculateNights()"></span> jour<span x-show="calculateNights() > 1">s</span> x {{ number_format($location->prix, 0, ',', ' ') }} <span>FCFA</span>
                            </span>
                            <span class="text-sm text-muted-foreground" x-text="formatPrice(calculateNights() * {{ $location->prix }})"></span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="t">Frais de service (5%)</span>
                            <span class="text-sm text-muted-foreground" x-text="formatPrice(calculateNights() * {{ $location->prix }} * 0.05)"></span>
                        </div>
                        <div class="flex justify-between pt-4 mt-4 text-lg font-bold border-t border-gray-200">
                            <span>Total</span>
                            <span class="text-xl font-bold text-primary" x-text="formatPrice(calculateNights() * {{ $location->prix }} * 1.05)"></span>
                        </div>
                    </div>
                @else
                    <!-- Pour les locations de type habitation -->
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <div class="flex justify-between mb-2">
                            <span>Caution (1 mois)</span>
                            <span class="text-sm text-muted-foreground">{{ number_format($location->prix, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>Frais d'agence (5%)</span>
                            <span class="text-sm text-muted-foreground">{{ number_format($location->prix * 0.05, 0, ',', ' ') }} FCFA</span>
                        </div>
                        <div class="flex justify-between pt-4 mt-4 text-lg font-bold border-t border-gray-200">
                            <span>Total initial</span>
                            <span class="text-xl font-bold text-primary">{{ number_format($location->prix * 2.05, 0, ',', ' ') }} FCFA</span>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Bouton de réservation -->
            <button
                data-modal-target="default-modal" data-modal-toggle="default-modal"
                :disabled="isRental && (!startDate || !endDate)"
                :class="{
                    'bg-primary hover:bg-primary/80': !isRental || (isRental && startDate && endDate), 
                    'bg-muted-foreground cursor-not-allowed': isRental && (!startDate || !endDate)
                }"
                class="w-full px-4 py-3 font-medium text-white transition-colors rounded-lg">
                Réserver maintenant
            </button>
        </div>
    </div>
</div> 