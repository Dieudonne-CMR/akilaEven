@if ($paginator->hasPages())
  <div class="flex justify-center mt-8">
    <nav class="flex items-center gap-1" aria-label="Pagination">
      {{-- Bouton Précédent --}}
      @if ($paginator->onFirstPage())
        <button disabled
          class="flex items-center justify-center w-10 h-10 text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed">
            <i class="ri-arrow-left-s-line"></i>
        </button>
      @else
        <a href="{{ $paginator->previousPageUrl() }}"
          class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">
            <i class="ri-arrow-left-s-line"></i>
        </a>
      @endif

      {{-- Les pages --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <span class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground">
            {{ $element }}
          </span>
        @endif

        {{-- Array de liens de pages --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <span
                class="flex items-center justify-center w-10 h-10 text-white border rounded-md border-primary bg-primary">
                {{ $page }}
              </span>
            @else
              <a href="{{ $url }}"
                class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">
                {{ $page }}
              </a>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Bouton Suivant --}}
      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
          class="flex items-center justify-center w-10 h-10 bg-white border border-gray-300 rounded-md text-muted-foreground hover:bg-gray-50">
            <i class="ri-arrow-right-s-line"></i>
        </a>
      @else
        <button disabled
          class="flex items-center justify-center w-10 h-10 text-gray-400 bg-white border border-gray-300 rounded-md cursor-not-allowed">
            <i class="ri-arrow-right-s-line"></i>
        </button>
      @endif
    </nav>
  </div>
@endif
