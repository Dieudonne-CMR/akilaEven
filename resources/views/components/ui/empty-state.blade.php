@props(['icon', 'title', 'message', 'classIcon'=>'', 'class'=>''])

<div class="{{ $class }} flex flex-col justify-center items-center  bg-gray-100 gap-2">
    <div class=" bg-gray-100 rounded-full size-16 flex justify-center items-center">
        <i data-lucide="{{ $icon }}" @class(['text-gray-500 size-8', $classIcon])></i>
    </div>
    <h3 class="mb-2 text-xl font-semibold text-gray-800">{{ $title }}</h3>
    <p class="max-w-md text-gray-600">{{ $message }}</p>
    <div class="flex justify-center items-center">
        {{ $slot }}
    </div>
   
</div>