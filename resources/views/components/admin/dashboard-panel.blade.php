@props([
    // classes par défaut pour le conteneur externe
    'outerClass' => 'p-4 sm:ml-64',
    // classes par défaut pour le conteneur intérieur
    'innerClass' => 'min-h-screen p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14',
])

<div {{ $attributes->merge(['class' => $outerClass]) }}>
    <div class="{{ $innerClass }}">
        {{ $slot }}
    </div>
</div>
