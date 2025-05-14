<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto ">
     <ul class="space-y-2 font-medium">
        @foreach($adminNavigationLinks as $link)
            <x-layout.sidebar-link :link="$link" />
        @endforeach
     </ul>
  </div>
</aside>