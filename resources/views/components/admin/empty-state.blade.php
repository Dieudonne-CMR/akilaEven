@props(['icon', 'title', 'message', 'bgClass' => 'bg-gray-100', 'iconClass' => 'text-gray-500'])

<div class="flex flex-col items-center justify-center py-12 text-center">
    <div class="p-6 mb-4 {{ $bgClass }} rounded-full">
        <i data-lucide="{{ $icon }}" class="w-12 h-12 {{ $iconClass }}"></i>
    </div>
    <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $title }}</h3>
    <p class="max-w-md text-gray-600 dark:text-gray-400">{{ $message }}</p>
</div> 