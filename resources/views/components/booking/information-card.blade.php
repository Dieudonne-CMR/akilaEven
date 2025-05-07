<div class="p-6 mb-6 bg-white rounded-lg shadow-md">
    <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-900">
        <i data-lucide="file-text" class="w-5 h-5 mr-2 text-blue-500"></i>
        Informations de Réservation
    </h2>
    
    <!-- Statut de la Réservation -->
    <div class="mb-6">
        <span class="text-sm font-medium text-gray-500">Statut</span>
        <div class="mt-1">
            {!! App\Helpers\BookingStatusHelper::getStatusBadge($booking->status) !!}
        </div>
    </div>
    
    <!-- ID de la Réservation -->
    <div class="mb-4">
        <span class="text-sm font-medium text-gray-500">ID Réservation</span>
        <p class="font-medium text-gray-900">{{ $booking->id }}</p>
    </div>
    
    <!-- Arrivée et Départ -->
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <span class="text-sm font-medium text-gray-500">Arrivée</span>
            <p class="font-medium text-gray-900">{{ $booking->arrival_time ? $booking->arrival_time->format('d/m/Y') : 'Non spécifié' }}</p>
            <p class="text-sm text-gray-500">À partir de 14h00</p>
        </div>
        <div>
            <span class="text-sm font-medium text-gray-500">Départ</span>
            <p class="font-medium text-gray-900">{{ $booking->departure_time ? $booking->departure_time->format('d/m/Y') : 'Non spécifié' }}</p>
            <p class="text-sm text-gray-500">Jusqu'à 12h00</p>
        </div>
    </div>
    
    <!-- Prix Total -->
    <div class="mb-4">
        <span class="text-sm font-medium text-gray-500">Prix Total</span>
        <p class="text-2xl font-bold text-blue-600">{{ number_format($booking->total_price, 0, ',', ' ') }} FCFA</p>
    </div>
    
    <!-- Statut de Paiement -->
    <div class="mb-4">
        @php
            $paymentStyle = App\Helpers\BookingStatusHelper::getStatusStyle($booking->status);
        @endphp
        <span class="text-sm font-medium text-gray-500">Statut de Paiement</span>
        <p class="flex items-center font-medium {{ $paymentStyle['text'] }}">
           
          
            <i data-lucide="{{ $paymentStyle['icon'] }}" class="size-4 mr-1.5 {{ $paymentStyle['text'] }}"></i>
            {!! App\Helpers\BookingStatusHelper::getPaymentStatusMessage($booking->status) !!}
        </p>
    </div>
    
    <hr class="my-6 border-gray-200">
    
    <!-- Informations du Client -->
    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
        <i data-lucide="user" class="w-5 h-5 mr-2 text-blue-500"></i>
        Informations du Client
    </h3>
    
    <!-- Nom du Client -->
    <div class="mb-4">
        <span class="text-sm font-medium text-gray-500">Nom Complet</span>
        <p class="font-medium text-gray-900">{{ $booking->full_name }}</p>
    </div>
    
    <!-- Informations de Contact -->
    <div class="mb-4">
        <span class="text-sm font-medium text-gray-500">Informations de Contact</span>
        <div class="flex items-center mt-1">
            <i data-lucide="mail" class="w-4 h-4 mr-2 text-gray-400"></i>
            <p class="text-gray-900">{{ $booking->email }}</p>
        </div>
        <div class="flex items-center mt-1">
            <i data-lucide="phone" class="w-4 h-4 mr-2 text-gray-400"></i>
            <p class="text-gray-900">{{ $booking->phone }}</p>
        </div>
    </div>
    
    <!-- Adresse -->
    <div class="mb-4">
        <span class="text-sm font-medium text-gray-500">Adresse</span>
        <div class="flex items-center mt-1">
            <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-gray-400 mt-0.5"></i>
            <p class="text-gray-900">
                {{ $booking->address }}@if($booking->city), {{ $booking->city }}@endif
            </p>
        </div>
    </div>
    
    <!-- Boutons d'Action -->
    <div class="mt-8 space-y-3">
        <button type="button" onclick="printReservation()" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center">
            <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
            Imprimer la Réservation
        </button>
    </div>
</div> 