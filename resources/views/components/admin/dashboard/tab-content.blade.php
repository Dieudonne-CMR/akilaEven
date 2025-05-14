@props(['active', 'title', 'description'])

<div>
    <div class="mb-4">
        <h3 class="text-xl font-bold text-gray-800">{{ $title }}</h3>
        <p class="text-gray-600">{{ $description }}</p>
    </div>
    
    <div class="relative overflow-x-auto">
        {{ $slot }}
    </div>
</div> 