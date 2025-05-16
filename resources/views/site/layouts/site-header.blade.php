<style>
  
  body {
      font-family: 'Poppins', sans-serif;
     
  }  
  
  .transition-all {
      transition: all 0.3s ease;
  }  
  .space-card:hover {
      transform: translateY(-5px);
  }  
  /* Header shadow on scroll */
  .header-shadow {
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
    
  /* Mobile menu animation */
  .mobile-menu {
      transition: transform 0.3s ease, opacity 0.3s ease;
  }
  
  .mobile-menu.hidden {
      transform: translateY(-20px);
      opacity: 0;
  }
</style>
<!-- Navigation Header -->
<header class="sticky top-0 left-0 right-0 z-50 h-auto bg-white header-shadow">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
          <!-- Logo -->
          <div class="flex items-center">
              <a href="#" class="flex items-center">
                  <div class="relative">
                      <i data-lucide="building-2" class="w-8 h-8 text-primary drop-shadow-[0_0_8px_rgba(147,51,234,0.7)]"></i>
                      <div class="absolute inset-0 rounded-full bg-gradient-to-r from-amber-500 to-purple-600 opacity-20 blur-sm"></div>
                  </div>
                  <span class="ml-2 text-lg font-bold text-transparent heading bg-gradient-to-r from-purple-300 to-purple-600 bg-clip-text drop-shadow-sm">Akila Immo</span>
              </a>
          </div>
           <!-- Desktop Navigation -->
          <x-layout.navigation-site :isDesktop="true" />
         
          
          <!-- User Actions -->
          <x-layout.auth.auth-btn :isDesktop="true" />
          
          <!-- Mobile Menu Button -->
          <div class="md:hidden">
              <button id="mobile-menu-button" class="cursor-pointer text-muted-foreground focus:outline-none">
                <i data-lucide="menu" class="size-6"></i>
                  
              </button>
          </div>
      </div>
  </div>
  
  <!-- Mobile Menu -->
  <x-layout.navigation-site :isDesktop="false" />
</header>

    <!-- JavaScript for Mobile Menu Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
            
            // Add shadow to header on scroll
            window.addEventListener('scroll', function() {
                const header = document.querySelector('header');
                if (window.scrollY > 10) {
                    header.classList.add('header-shadow');
                } else {
                    header.classList.remove('header-shadow');
                }
            });
        });
    </script>