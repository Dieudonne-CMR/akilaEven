@props(['title', 'value', 'icon', 'iconClass' => 'text-blue-600 dark:text-blue-300', 'iconBg' => 'bg-blue-100 dark:bg-blue-900', 'subtitle' => null, 'trend' => null, 'trendValue' => null])

<div class="h-full p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <div class="flex items-center">
        <div class="p-3 mr-4 rounded-full {{ $iconBg }}">
            <i data-lucide="{{ $icon }}" class="w-8 h-8 {{ $iconClass }}"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $title }}</p>
            <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $value }}</h3>
            
            @if($subtitle)
                <p class="flex items-center mt-1 text-sm text-gray-600 dark:text-gray-400">
                    <span>{{ $subtitle }}</span>
                </p>
            @endif
            
            @if($trend && $trendValue)
                <p class="flex items-center mt-1 text-sm {{ $trendValue >= 0 ? 'text-green-600 dark:text-green-500' : 'text-red-600 dark:text-red-500' }}">
                    <i data-lucide="{{ $trendValue >= 0 ? 'trending-up' : 'trending-down' }}" class="w-4 h-4 mr-1"></i>
                    <span>{{ abs($trendValue) }}% {{ $trend }}</span>
                </p>
            @endif
        </div>
    </div>
</div> 