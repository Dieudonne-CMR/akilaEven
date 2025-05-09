@props(['agence'])

<div class="p-6 mt-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <h2 class="flex items-center mb-4 text-xl font-bold text-gray-900 dark:text-white">
       <i data-lucide="list" class="w-5 h-5 mr-2 text-blue-600"></i>
       Gestion des salles et locations
    </h2>
    
    <!-- Tabs -->
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
       <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
          <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="locations-tab" data-tabs-target="#locations" type="button" role="tab" aria-controls="locations" aria-selected="false">Locations ({{ $agence->locations->count() }})</button>
          </li>
          <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="halls-tab" data-tabs-target="#halls" type="button" role="tab" aria-controls="halls" aria-selected="false">Salles de fête ({{ $agence->eventHalls->count() }})</button>
          </li>
       </ul>
    </div>
    
    <!-- Tab Content -->
    <div id="myTabContent">
        <!-- Locations -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="locations" role="tabpanel" aria-labelledby="locations-tab">
            @if($agence->locations->count() > 0)
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                <th scope="col" class="px-6 py-3">Nom</th>
                                <th scope="col" class="px-6 py-3">Capacité</th>
                                <th scope="col" class="px-6 py-3">Prix</th>
                                <th scope="col" class="px-6 py-3">Statut</th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                        </thead>
                        <tbody>
                                @foreach($agence->locations as $location)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $location->name }}
                                    </th>
                                    <td class="px-6 py-4">{{ $location->capacity }} pers.</td>
                                    <td class="px-6 py-4">{{ number_format($location->price, 0, ',', ' ') }} FCFA</td>
                                    <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs font-medium {{ $location->status === 'available' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} rounded-full">
                                            {{ $location->status === 'available' ? 'Disponible' : 'Indisponible' }}
                                            </span>
                                    </td>
                                    <td class="px-6 py-4">
                                            <a href="#" class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Voir</a>
                                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Supprimer</a>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center p-8 text-gray-500 dark:text-gray-400">
                    <i data-lucide="bed-empty" class="w-12 h-12 mb-4"></i>
                    <p class="mb-2 text-lg font-medium">Aucune location disponible</p>
                    <p class="mb-6 text-sm">Cet agence n'a pas encore de locations enregistrées.</p>
                    <a href="{{ route('locations.create', $agence) }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                        <i data-lucide="plus" class="inline w-4 h-4 mr-1"></i>
                        Ajouter une location
                    </a>
                </div>
            @endif
        </div>
        
        <!-- Salles de fête -->
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="halls" role="tabpanel" aria-labelledby="halls-tab">
            <x-agence.event-halls-table :agence="$agence" />
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des onglets
        const tabElements = document.querySelectorAll('#myTab button');
        const tabContents = document.querySelectorAll('#myTabContent > div');
        
        // Fonction pour activer un onglet
        function showTab(tabId) {
            tabElements.forEach(tab => {
                const target = tab.getAttribute('data-tabs-target');
                if (target === '#' + tabId) {
                    tab.classList.add('border-blue-600', 'text-blue-600');
                    tab.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                    tab.setAttribute('aria-selected', 'true');
                } else {
                    tab.classList.remove('border-blue-600', 'text-blue-600');
                    tab.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                    tab.setAttribute('aria-selected', 'false');
                }
            });
            
            tabContents.forEach(content => {
                if (content.id === tabId) {
                    content.classList.remove('hidden');
                } else {
                    content.classList.add('hidden');
                }
            });
        }
        
        // Attacher les événements aux onglets
        tabElements.forEach(tab => {
            tab.addEventListener('click', function() {
                const target = this.getAttribute('data-tabs-target').substring(1);
                showTab(target);
            });
        });
        
        // Afficher le premier onglet par défaut
        if (tabElements.length > 0) {
            const firstTabTarget = tabElements[0].getAttribute('data-tabs-target').substring(1);
            showTab(firstTabTarget);
        }
    });
</script>
@endpush 