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
      <div class="flex items-center justify-between h-28">
          <!-- Logo -->
          <div class="flex items-center">
              <a href="#" class="flex items-center">
                  <svg class="w-8 h-8 text-amber-600" viewBox="0 0 24 24" fill="currentColor">
                      <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                  </svg>
                  <span class="ml-2 text-xl font-bold heading">VenueHub</span>
              </a>
          </div>
           <!-- Desktop Navigation -->
          <x-navigation-site :isDesktop="true" />
         
          
          <!-- User Actions -->
          <x-auth.auth-btn :isDesktop="true" />
          
          <!-- Mobile Menu Button -->
          <div class="md:hidden">
              <button id="mobile-menu-button" class="cursor-pointer text-muted-foreground focus:outline-none">
                <i data-lucide="menu" class="size-6"></i>
                  
              </button>
          </div>
      </div>
  </div>
  
  <!-- Mobile Menu -->
  <x-navigation-site :isDesktop="false" />
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