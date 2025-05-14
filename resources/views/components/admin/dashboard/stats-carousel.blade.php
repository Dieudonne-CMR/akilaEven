
@php
    use App\Helpers\DashboardStatsHelper;
     // Récupérer les statistiques pour le carrousel
        
    $stats = DashboardStatsHelper::getStatistics();
@endphp

<div class="p-4 mb-6 bg-white rounded-lg shadow-sm">
    <h2 class="mb-4 text-lg font-semibold text-gray-800">Statistiques clés</h2>
    
    <!-- Swiper Carousel -->
    <div class="swiper statisticsSwiper">
        <div class="pb-5 swiper-wrapper" style="height: auto">
            @foreach($stats as $stat)
                <div class="swiper-slide">
                    <x-admin.dashboard.stats-card 
                        :title="$stat['title']"
                        :value="$stat['value']"
                        :icon="$stat['icon']"
                        :badge="$stat['badge'] ?? null"
                        :badgeText="$stat['badgeText'] ?? ''"
                        :gradientFrom="$stat['gradientFrom']"
                        :gradientTo="$stat['gradientTo']"
                    />
                </div>
            @endforeach
        </div>
        
        <!-- Swiper Pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Initialize Swiper -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.statisticsSwiper', {
            slidesPerView: 1,
            spaceBetween: 16,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });
    });
</script> 