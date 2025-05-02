@props(['link'])

<li>
   <a href="{{ route($link['route']) }}" 
      class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['is_active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
      <i data-lucide="{{ $link['icon'] }}" class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
      <span class="flex-1 ms-3 whitespace-nowrap">{{ $link['text'] }}</span>
      
      @if(isset($link['badge']))
        <span class="inline-flex items-center justify-center px-2 text-sm font-medium {{ $link['badge']['class'] }} rounded-full ms-3 dark:bg-gray-700 dark:text-gray-300">
          {{ $link['badge']['text'] }}
        </span>
      @endif
   </a>
</li> 