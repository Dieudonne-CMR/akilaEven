@props([
  'links' => $globalNavigationLinks,
'isDesktop' => true
])

@if($isDesktop)
<nav class="hidden space-x-8 md:flex">
  
  @foreach($links as $link)
    @php
      $isActive = request()->routeIs($link['active'] ?? []);
    @endphp
  <a href="{{route($link['route']) }}"
           class=" py-5! transition-all group text-base {{ $isActive ? '!text-primary font-semibold' : 'text-muted-foreground hover:text-primary' }}">
          <span class="relative">
            {{ $link['text'] }}
            @if($isActive)
              <span class="mt-2 absolute -bottom-1 left-0 w-full h-0.5 !bg-primary transition-transform duration-200"></span>
            @endif
          </span>
  @endforeach
</nav>
@else
  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden bg-white border-t border-gray-200 mobile-menu md:hidden">
    <div class="px-2 pt-2 pb-3 space-y-1">
      @foreach ($links as $link )
        @php
            $isActive = request()->routeIs($link['active'] ?? []);
        @endphp
        <a href="#" class="block px-3 py-2 text-base {{ $isActive ? "!text-primary font-semibold bg-primary/20" : "text-muted-foreground hover:text-primary"}} rounded-md ">{{ $link["text"] }}</a>
      @endforeach
     
    </div>
    <x-layout.auth.auth-btn :isDesktop="false" />
  </div>
@endif

    

{{-- @foreach($links as $link)
        @php
            $isActive = request()->routeIs($link['active'] ?? []);
        @endphp
        
        <a href="{{route($link['route']) }}"
           class="{{ !$isDesktop ? "block text-center" : "inline-flex items-center px-3 py-2" }} group hover:text-primary text-sm text-muted-foreground  font-medium  {{ $isActive ? '!text-primary' : '' }}">
          <span class="relative">
            {{ $link['text'] }}
            <span class="absolute bottom-0 left-0 w-full h-0.5 !bg-primary transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
          </span>
        </a>
    @endforeach --}}