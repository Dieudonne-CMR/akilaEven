@guest
<a href="{{ route('login') }}"
   class="inline-flex items-center px-4 py-2 text-sm font-medium transition-colors duration-200 rounded-md !text-primary">
  Connexion
</a>
<a href="{{ route('register') }}"
   class="inline-flex items-center px-3 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-md !bg-primary">
  Créer votre espace
</a>
@else
<a href="{{ route('dashboard') }}"
   class="inline-flex items-center px- py-2 text-sm font-medium text-primary transition-colors duration-200 !bg-primary rounded-full">
  Mon espace
</a>
@endguest
