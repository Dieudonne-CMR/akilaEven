@props(['message' => null, 'type' => 'success', 'position' => 'top-right'])

@php
$typeClasses = [
    'success' => 'text-green-500 bg-green-100',
    'error' => 'text-red-500 bg-red-100',
    'warning' => 'text-yellow-500 bg-yellow-100',
    'info' => 'text-blue-500 bg-blue-100',
];

$positionClasses = [
    'top-right' => 'top-5 right-5',
    'top-left' => 'top-5 left-5',
    'bottom-right' => 'bottom-5 right-5',
    'bottom-left' => 'bottom-5 left-5',
    'top-center' => 'top-5 left-1/2 transform -translate-x-1/2',
    'bottom-center' => 'bottom-5 left-1/2 transform -translate-x-1/2',
];
@endphp

<div
    x-data="{
        show: true,
        message: @js($message),
        type: @js($type),
        typeClasses: @js($typeClasses),
        timeout: null,
        showToast(message, type = 'success') {
            this.message = message;
            this.type = type;
            this.show = true;
            
            if (this.timeout) {
                clearTimeout(this.timeout);
            }
            
            this.timeout = setTimeout(() => {
                this.show = false;
            }, 3000);
        }
    }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
    @@toast.window="showToast(message, type)"
    {{-- x-on:toast.window="showToast('dd', 'success')" --}}
    class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm {{ $position ? 'fixed ' . $positionClasses[$position] : '' }} z-50"
    role="alert"
    style="display: none;
    "
      x-init="
      {{-- si un message de session existe, on le montre immédiatement --}}
      message && showToast(message, type)
    "
>
    <div :class="typeClasses[type]" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg">
        <template x-if="type === 'success'">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/></svg>
        </template>
        <template x-if="type === 'error'">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.5 11.5a1 1 0 0 1-2 0v-4a1 1 0 0 1 2 0v4Zm-3.5 3a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z"/></svg>
        </template>
        <template x-if="type === 'warning'">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/></svg>
        </template>
        <template x-if="type === 'info'">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/></svg>
        </template>
    </div>
    <div x-text="message" class="ml-3 text-sm font-normal"></div>
    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" @click="show = false">
        <span class="sr-only">Fermer</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
    </button>
</div>