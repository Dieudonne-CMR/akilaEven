@props(['icon', 'title', 'message'])

<div class="flex flex-col items-center justify-center py-12 text-center">
    <div class="p-6 mb-4 bg-gray-100 rounded-full">
        <i data-lucide="{{ $icon }}" class="w-12 h-12 text-gray-500"></i>
    </div>
    <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ $title }}</h3>
    <p class="max-w-md text-gray-600">{{ $message }}</p>
</div> 