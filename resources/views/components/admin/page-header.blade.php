@props(['title', 'description', 'count' => null, 'countLabel' => '', 'icon' => null])

<div class="p-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
    <p class="mt-1 text-gray-600 dark:text-gray-400">{{ $description }}</p>
    
    @if($count !== null)
    <div class="inline-flex items-center px-3 py-1 mt-4 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
        @if($icon)
        <i data-lucide="{{ $icon }}" class="w-4 h-4 mr-1"></i>
        @endif
        <span>{{ $count }} {{ $countLabel }}</span>
    </div>
    @endif
</div> 