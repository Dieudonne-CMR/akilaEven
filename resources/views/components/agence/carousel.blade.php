@props(['bannieres' => []])

@php
    // Filtrer les bannières non vides
    $images = collect($bannieres)->filter(function($url) {
        return !empty($url);
    })->all();
    
    // Générer un ID unique pour le carrousel
    $carouselId = 'carousel-' . uniqid();
@endphp

<!-- Carousel -->
@if(count($images) > 0)
    <div class="overflow-hidden rounded-xl swiper headerSwiper h-[50vh] md:h-[60vh] lg:h-[70vh]">
        <div class="swiper-wrapper">
            @foreach($images as $image)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $image) }}" 
                        alt="Bannière de l'agence" 
                        class="object-cover w-full h-full">
                </div>
            @endforeach
        </div>
        @if(count($images) > 1)
            <div class="swiper-pagination"></div>
        @endif
    </div>
@else
    <div class="flex items-center justify-center h-[50vh] md:h-[60vh] lg:h-[70vh] bg-gray-200 rounded-xl dark:bg-gray-700">
        <span class="text-gray-500 dark:text-gray-400">
            <i data-lucide="image-off" class="w-16 h-16 mx-auto mb-2"></i>
            <p class="text-center">Aucune image disponible</p>
        </span>
    </div>
@endif

@once
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.querySelector('.headerSwiper')) {
                new Swiper('.headerSwiper', {
                    loop: {{ count($images) > 1 ? 'true' : 'false' }},
                    autoplay: {
                        delay: 5000,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            }
        });
    </script>
    @endpush
@endonce 