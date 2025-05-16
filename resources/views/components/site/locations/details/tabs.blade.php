@props(['location'])

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
            @if(!empty($location->description_location))
                <p class="text-gray-700">{{ $location->description_location }}</p>
            @else
                <p class="text-gray-700">Aucune description disponible pour cette location</p>
            @endif
        </div>
        
        <!-- Équipements -->
        <div x-show="activeTab === 'equipements'" class="space-y-4" x-cloak>
            @php
                // Liste des équipements réels ou par défaut si non définis
                $equipements = $location->equipments ?? [];
                
                // Si équipements est une chaîne JSON, la convertir en tableau
                if (is_string($equipements) && !empty($equipements)) {
                    $equipements = json_decode($equipements, true) ?? [$equipements];
                } elseif (empty($equipements)) {
                    $equipements = [];
                }
            @endphp
            
            @if(count($equipements) > 0)
                <ul class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @foreach($equipements as $equipement)
                        <li class="flex items-center">
                            <i class="w-5 h-5 mr-2 text-green-500 fas fa-check-circle"></i>
                            {{ $equipement }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-700">Aucun équipement spécifié pour cette location</p>
            @endif
        </div>
        
        <!-- Règlement -->
        <div x-show="activeTab === 'reglement'" class="space-y-4" x-cloak>
            @if(!empty($location->rules))
                <div class="rules-content">
                    {!! $location->rules !!}
                </div>
            @else
                <p class="text-gray-700">Aucun règlement spécifié pour cette location</p>
            @endif
        </div>
    </div>
</div> 