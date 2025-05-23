@props(['title', 'value', 'icon', 'badge' => null, 'badgeText' => '', 'gradientFrom', 'gradientTo'])

<div class="p-4 rounded-lg shadow-md bg-linear-to-br from-{{ $gradientFrom }}-500 to-{{ $gradientTo }}-700">
    <div class="flex items-start justify-between">
        <div>
            <p class="text-sm font-medium text-white">{{ $title }}</p>
            <h3 class="mt-1 text-2xl font-bold text-white">{{ $value }}</h3>
            @if($badge)
            <p class="mt-2 text-xs text-{{ $gradientFrom }}-100">
                <span class="bg-{{ $gradientFrom }}-100 text-{{ $gradientFrom }}-800 text-xs font-medium px-2 py-0.5 rounded-full">{{ $badge }}</span>
                <span class="ml-1">{{ $badgeText }}</span>
            </p>
            @endif
        </div>
        <div class="p-2 rounded-lg bg-white/20">
            <i data-lucide="{{ $icon }}" class="w-6 h-6 text-white"></i>
        </div>
    </div>
</div> 