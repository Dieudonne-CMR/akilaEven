@props([
  'links' => $globalNavigationLinks,
'isDesktop' => true
])

<nav {{ $attributes->merge([
  'class' => Arr::toCssClasses([
    
      $isDesktop ? "hidden lg:flex lg:space-x-8": "space-y-4 flex flex-col items-center justify-center",
  ])
])  }}>
    @foreach($links as $link)
        @php
            $isActive = request()->routeIs($link['active'] ?? []);
        @endphp
        
        <a href="{{route($link['route']) }}"
           class="{{ !$isDesktop ? "block text-lg text-center" : "inline-flex items-center px-3 py-2 text-sm " }}  group  font-medium  {{ $isActive ? '!text-primary' : '!text-muted-foreground !hover:text-primary' }}">
          <span class="relative">
            {{ $link['text'] }}
            <span class="absolute bottom-0 left-0 w-full h-0.5 !bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200 {{ $isActive ? 'scale-x-100' : '' }}"></span>
          </span>
        </a>
    @endforeach
</nav>