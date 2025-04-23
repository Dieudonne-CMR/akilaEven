<!-- Navigation Header -->
<header x-data="{ open: false }" class="sticky top-0 z-[2000] w-full bg-white shadow-sm">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <div class="max-lg:flex max-lg:items-center max-lg:justify-between m=ax-lg:w-full">
        <a href="{{ route('home') }}"
           class="text-2xl font-bold text-blue-600 transition-colors duration-200 hover:text-blue-800">
          AkilaEven
        </a>
        <!-- Mobile menu button -->
        <button type="button"
                class="inline-flex items-center justify-center p-2 ml-3 text-gray-400 rounded-md hover:text-gray-500 hover:bg-gray-100 lg:hidden"
                @click="open = true"
                aria-label="Ouvrir le menu">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Desktop Navigation -->
     <x-navigation-site class="my-6" />

      <!-- Desktop Authentication Buttons -->
      <div class="hidden lg:flex lg:items-center lg:space-x-4">
        @include('site.layouts.partials.auth-btn')
      </div>
    </div>
  </div>

  <!-- Mobile Navigation Sheet -->
  <div
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-end justify-center lg:hidden"
    aria-modal="true"
    role="dialog"
  >
    <!-- Backdrop -->
    <div
      class="fixed inset-0 transition-opacity bg-black bg-opacity-50"
      @click="open = false"
      aria-hidden="true"
    ></div>

    <!-- Sheet Panel -->
    <div
      class="relative w-full max-h-[80vh] bg-white rounded-t-2xl p-6 overflow-y-auto transform transition-transform duration-300"
      :class="open ? 'translate-y-0' : 'translate-y-full'"
    >
      <!-- Close Button -->
      <button
        class="absolute p-2 text-gray-500 rounded-full top-4 right-4 hover:text-gray-700 hover:bg-gray-100"
        @click="open = false"
        aria-label="Fermer le menu"
      >
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-6 h-6"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
          <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
      <x-navigation-site class="my-6" :isDesktop="false" />
      <!-- Mobile Navigation Links -->
    {{--   <nav class="space-y-4">
        <a href="{{ route('home') }}"
           class="block text-lg font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors duration-200">
          Accueil
        </a>
        <a href="#"
           class="block text-lg font-medium text-gray-700 transition-colors duration-200 hover:text-blue-600">
          Chambres d'hôtel
        </a>
        <a href="{{ route('site.sallesfetes') }}"
           class="block text-lg font-medium {{ request()->routeIs('site.sallesfetes') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors duration-200">
          Salles de fêtes
        </a>
        <a href="{{ route('site.bl-about.about') }}"
           class="block text-lg font-medium {{ request()->routeIs('site.bl-about.about') ? 'text-blue-600' : 'text-gray-700 hover:text-blue-600' }} transition-colors duration-200">
          À propos
        </a>
        <a href="#"
           class="block text-lg font-medium text-gray-700 transition-colors duration-200 hover:text-blue-600">
          Contact
        </a>
      </nav> --}}

      <!-- Mobile Authentication Buttons -->
      <div class="flex items-center justify-center mt-6 ">
        @include('site.layouts.partials.auth-btn')
      </div>
    </div>
  </div>
</header>