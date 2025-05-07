
<div class="p-6 mb-6 bg-white rounded-lg shadow-md">
    <h2 class="flex items-center mb-4 text-xl font-semibold text-gray-900">
        <i data-lucide="home" class="w-5 h-5 mr-2 text-blue-500"></i>
        Détails de la Salle
    </h2>
    
    <!-- Galerie d'Images avec Swiper -->
    <div class="mb-6" x-data="{ activeImage: 0, totalImages: 0 }" x-init="totalImages = document.querySelectorAll('.swiper-container .swiper-slide').length">
        <!-- Image Principale -->
        <div class="relative mb-4 overflow-hidden rounded-lg">
          @php
          $validPhotos = App\Helpers\getValidImagesHelper::getValidImages($eventHall);
          @endphp
          {{-- @dd($validPhotos); --}}
          @if(count($validPhotos) > 0)
              @if(count($validPhotos) == 1)
                  <img src="{{ asset('storage/' . $validPhotos["photo"]) }}" 
                      alt="{{ $eventHall->nom_salle }}" 
                      class="w-full h-[300px] sm:h-[400px] object-cover rounded-lg"
                      loading="lazy">
              @else
                  <div class="swiper-container" id="event-hall-gallery">
                      <div class="swiper-wrapper">
                          @foreach($validPhotos as $photo)
                              <div class="swiper-slide">
                                  <img src="{{ asset('storage/' . $photo) }}" 
                                      alt="{{ $eventHall->nom_salle }}" 
                                      class="w-full h-[300px] sm:h-[400px] object-cover rounded-lg"
                                      loading="lazy">
                              </div>
                          @endforeach
                      </div>
                  </div>
                  
                  <!-- Navigation Arrows -->
                  <button class="absolute p-2 text-white transition-all -translate-y-1/2 rounded-full swiper-button-prev left-2 top-1/2 bg-black/50 hover:bg-black/70">
                      
                  </button>
                  <button class="absolute p-2 text-white transition-all -translate-y-1/2 rounded-full swiper-button-next right-2 top-1/2 bg-black/50 hover:bg-black/70">
                      
                  </button>
                  
                  <!-- Image Counter -->
                  <div class="absolute z-50 px-3 py-1 text-sm text-white rounded-full bottom-4 right-4 bg-black/50" id="image-counter"></div>
              @endif
          @else
              <div class="flex items-center justify-center w-full h-[300px] sm:h-[400px] bg-gray-200 rounded-lg">
                  <span class="text-gray-500">Aucune image disponible</span>
              </div>
          @endif
        </div>
      
        
        <!-- Thumbnail Grid -->
@if(count($validPhotos) > 1)
<div class="grid grid-cols-5 gap-2" id="thumbnail-container">
    @foreach($validPhotos as $index => $photo)
        <div class="overflow-hidden transition-all rounded-lg cursor-pointer swiper-thumb @if($loop->first) ring-2 ring-blue-500 @endif" 
             data-index="{{ $loop->index }}"
             title="Voir l'image {{ (int)$index + 1 }}">
            <img src="{{ asset('storage/' . $photo) }}" 
                 alt="{{ $eventHall->nom_salle }} thumbnail" 
                 class="object-cover w-full h-16"
                 loading="lazy">
        </div>
    @endforeach
</div>
@endif
    </div>
    
    <!-- Nom et Description de la Salle -->
    <div class="mb-6">
        <h3 class="mb-2 text-2xl font-bold text-gray-900">{{ $eventHall->nom_salle }}</h3>
        <p class="text-gray-700">{{ $eventHall->description_salle }}</p>
    </div>
    
    <!-- Grille de Détails de la Salle -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
        <!-- Prix -->
        <div class="flex items-start">
            <div class="p-2 mr-3 bg-blue-100 rounded-full">
                <i data-lucide="tag" class="w-5 h-5 text-blue-600"></i>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500">Prix de Location</h4>
                <p class="text-lg font-semibold text-gray-900">{{ number_format($eventHall->prix, 0, ',', ' ') }} FCFA par jour</p>
            </div>
        </div>
        
        <!-- Capacité -->
        <div class="flex items-start">
            <div class="p-2 mr-3 bg-blue-100 rounded-full">
                <i data-lucide="users" class="w-5 h-5 text-blue-600"></i>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500">Capacité</h4>
                <p class="text-lg font-semibold text-gray-900">{{ number_format($eventHall->capacite, 0, ',', ' ') }} personnes</p>
            </div>
        </div>
        
        <!-- Emplacement -->
        <div class="flex items-start">
            <div class="p-2 mr-3 bg-blue-100 rounded-full">
                <i data-lucide="map-pin" class="w-5 h-5 text-blue-600"></i>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500">Emplacement</h4>
                <p class="text-lg font-semibold text-gray-900">{{ $eventHall->ville->nom ?? 'Non spécifié' }}</p>
                <p class="text-sm text-gray-500">{{ $eventHall->localisation }}</p>
            </div>
        </div>
        
        <!-- Superficie -->
        <div class="flex items-start">
            <div class="p-2 mr-3 bg-blue-100 rounded-full">
                <i data-lucide="square" class="w-5 h-5 text-blue-600"></i>
            </div>
            <div>
                <h4 class="text-sm font-medium text-gray-500">Superficie</h4>
                <p class="text-lg font-semibold text-gray-900">{{ $eventHall->area ?? '0' }} m²</p>
            </div>
        </div>
    </div>
    
    <!-- Équipements -->
    <div class="mb-6">
        <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
            <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-blue-500"></i>
            Équipements Disponibles
        </h3>
        
        <div class="grid grid-cols-2 gap-3 md:grid-cols-3">
            @if(is_array($eventHall->equipments) && count($eventHall->equipments) > 0)
                @foreach($eventHall->equipments as $equipment)
                    <div class="flex items-center">
                        <i data-lucide="check" class="w-4 h-4 mr-2 text-green-500"></i>
                        <span class="text-gray-700">{{ $equipment }}</span>
                    </div>
                @endforeach
            @else
                <div class="col-span-full">
                    <p class="text-gray-500">Aucun équipement spécifié pour cette salle.</p>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Carte -->
    <div class="mb-6">
        <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
            <i data-lucide="map" class="w-5 h-5 mr-2 text-blue-500"></i>
            Carte de Localisation
        </h3>
        
        <div class="overflow-hidden border border-gray-200 rounded-lg">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.3059353029!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1619826381635!5m2!1sen!2s" 
                width="100%" 
                height="300" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
            ></iframe>
        </div>
    </div>
    
    <!-- Règles -->
    <div class="mb-6">
        <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900">
            <i data-lucide="shield" class="w-5 h-5 mr-2 text-blue-500"></i>
            Règles
        </h3>
        
        <div class="p-4 rounded-lg bg-gray-50">
            @if(is_array($eventHall->rules) && count($eventHall->rules) > 0)
                @foreach($eventHall->rules as $index => $rule)
                    <div class="{{ !$loop->last ? 'mb-3' : '' }}">
                        <h4 class="font-medium text-gray-900">{{ $index + 1 }}. {{ $rule['title'] ?? 'Règle' }}</h4>
                        <p class="text-sm text-gray-700">{{ $rule['description'] ?? $rule }}</p>
                    </div>
                @endforeach
            @else
                <div>
                    <h4 class="font-medium text-gray-900">Politique d'Annulation</h4>
                    <p class="text-sm text-gray-700">Annulation gratuite jusqu'à 48 heures avant l'arrivée. Les annulations effectuées moins de 48 heures avant l'arrivée sont soumises à des frais équivalents à 50% du montant total de la réservation.</p>
                </div>
                <div class="mt-3">
                    <h4 class="font-medium text-gray-900">Exigences Particulières</h4>
                    <p class="text-sm text-gray-700">Interdit de fumer. Animaux non admis. Pas de fêtes ou d'événements sans approbation préalable.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
      const galleryEl = document.getElementById('event-hall-gallery');
    if (!galleryEl) return;

    const swiper = new Swiper(galleryEl, {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: false, // Désactivé pour simplifier la synchronisation avec les miniatures
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            init: function(sw) {
                updateCounter(sw.activeIndex + 1, sw.slides.length);
                highlightThumbnail(sw.activeIndex);
            },
            slideChange: function(sw) {
                updateCounter(sw.activeIndex + 1, sw.slides.length);
                highlightThumbnail(sw.activeIndex);
            }
        }
    });

    // Mettre à jour le compteur d'images
    function updateCounter(current, total) {
        const counterEl = document.getElementById('image-counter');
        if (counterEl) {
            counterEl.textContent = current + '/' + total;
        }
    }

    // Gérer les miniatures
    function highlightThumbnail(index) {
        const thumbnails = document.querySelectorAll('.swiper-thumb');
        thumbnails.forEach((thumb, i) => {
            if (i === index) {
                thumb.classList.add('ring-2', 'ring-blue-500');
                thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
            } else {
                thumb.classList.remove('ring-2', 'ring-blue-500');
            }
        });
    }

    // Gestion des clics sur les miniatures
    document.querySelectorAll('.swiper-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            const index = parseInt(this.getAttribute('data-index'));
            swiper.slideTo(index);
        });
    });
    });
</script> 