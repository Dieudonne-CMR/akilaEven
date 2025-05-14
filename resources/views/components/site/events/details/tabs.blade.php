@props(['eventHall'])

<div x-data="{ activeTab: 'description' }" class="mb-8">
    <div class="flex border-b border-gray-200">
        <button 
            @click="activeTab = 'description'" 
            :class="{'border-b-2 border-primary text-primary': activeTab === 'description', 'text-gray-500': activeTab !== 'description'}"
            class="px-6 py-4 font-medium">
            Description
        </button>
        <button 
            @click="activeTab = 'equipements'" 
            :class="{'border-b-2 border-primary text-primary': activeTab === 'equipements', 'text-gray-500': activeTab !== 'equipements'}"
            class="px-6 py-4 font-medium">
            Équipements
        </button>
        <button 
            @click="activeTab = 'reglement'" 
            :class="{'border-b-2 border-primary text-primary': activeTab === 'reglement', 'text-gray-500': activeTab !== 'reglement'}"
            class="px-6 py-4 font-medium">
            Règlement
        </button>
    </div>
    
    <!-- Contenu des onglets -->
    <div class="py-6">
        <!-- Description -->
        <div x-show="activeTab === 'description'" class="space-y-4">
            <p class="text-gray-700">
                @if(!empty($eventHall->description_salle))
                <p>{{ $eventHall->description_salle }}</p>
            @else
                Aucune description disponible pour cette salle
            @endif
            </p>
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