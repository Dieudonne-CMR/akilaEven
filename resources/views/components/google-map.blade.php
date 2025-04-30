@props([
    'latitude' => '48.8566',
    'longitude' => '2.3522',
    'zoom' => '15',
    'height' => '400px',
    'width' => '100%',
    'apiKey' => config('services.google.maps_api_key', ''),
    'mapTitle' => 'Notre emplacement'
])

<div class="google-map-container mb-4">
    <div 
        id="google-map" 
        class="google-map" 
        style="height: {{ $height }}; width: {{ $width }};"
        data-latitude="{{ $latitude }}"
        data-longitude="{{ $longitude }}"
        data-zoom="{{ $zoom }}"
        title="{{ $mapTitle }}"
        aria-label="{{ $mapTitle }}"
    >
        <!-- La carte sera chargée ici -->
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Si l'API Google Maps n'est pas disponible, afficher une iframe de secours
        if (typeof google === 'undefined' || typeof google.maps === 'undefined') {
            const mapContainer = document.getElementById('google-map');
            const latitude = mapContainer.dataset.latitude;
            const longitude = mapContainer.dataset.longitude;
            const zoom = mapContainer.dataset.zoom;
            
            const iframe = document.createElement('iframe');
            iframe.src = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2624.9983685732213!2d${longitude}!3d${latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDjCsDUxJzI0LjAiTiAywrAyMScwOC4wIkU!5e0!3m2!1sfr!2sfr!4v1625124512345!5m2!1sfr!2sfr`;
            iframe.width = '100%';
            iframe.height = '100%';
            iframe.frameBorder = '0';
            iframe.style.border = '0';
            iframe.allowFullscreen = true;
            iframe.setAttribute('loading', 'lazy');
            iframe.setAttribute('referrerpolicy', 'no-referrer-when-downgrade');
            iframe.setAttribute('aria-label', mapContainer.getAttribute('aria-label'));
            iframe.setAttribute('title', mapContainer.getAttribute('title'));
            
            mapContainer.appendChild(iframe);
        } else {
            // Initialiser la carte Google Maps
            initMap();
        }
    });

    function initMap() {
        const mapContainer = document.getElementById('google-map');
        const latitude = parseFloat(mapContainer.dataset.latitude);
        const longitude = parseFloat(mapContainer.dataset.longitude);
        const zoom = parseInt(mapContainer.dataset.zoom);
        
        const position = { lat: latitude, lng: longitude };
        
        const map = new google.maps.Map(mapContainer, {
            center: position,
            zoom: zoom,
            mapTypeControl: true,
            scrollwheel: false,
            zoomControl: true,
            streetViewControl: true,
            fullscreenControl: true
        });
        
        const marker = new google.maps.Marker({
            position: position,
            map: map,
            animation: google.maps.Animation.DROP,
            title: mapContainer.getAttribute('title')
        });
    }
</script>

@if($apiKey)
<script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>
@endif
@endpush 