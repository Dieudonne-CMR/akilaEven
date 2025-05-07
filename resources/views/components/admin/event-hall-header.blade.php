@props(['hotel'])

<div class="flex items-start justify-between gap-4 mb-8 md:items-center max-md:flex-col">
    <div class="max-w-2xl">
        <a href="{{ route('admin.hotels.show', $hotel->id) }}" class="inline-flex items-center mb-4 text-gray-600 transition-colors hover:text-blue-600 group">
            <i data-lucide="arrow-left" class="w-5 h-5 mr-2 transition-transform group-hover:-translate-x-1"></i>
            Retour à l'Hôtel
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Ajouter une Nouvelle Salle de Réception pour l'Hôtel <span class="text-blue-600">{{ $hotel->nom_hotel }}</span></h1>
        <p class="mt-2 text-gray-600">Veuillez compléter les informations pour répertorier la salle</p>
    </div>
    <a class="max-w-lg shrink-0 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" href="{{ route('admin.hotels.show', $hotel->id) }}">
        <i data-lucide="file-search-2" class="mr-2 size-4"></i> Voir l'hôtel
    </a>
</div> 