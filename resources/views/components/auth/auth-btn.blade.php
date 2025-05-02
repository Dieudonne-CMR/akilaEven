@props(['isDesktop' => 'true' ])
@if($isDesktop)
@guest
<!-- User Actions -->
<div class="items-center hidden space-x-4 md:flex">
  <a href="{{ route('login') }}" class="transition-all text-muted-foreground hover:text-primary">Se connecter</a>
  <a href="{{ route('register') }}" class="px-4 py-2 text-white transition-all rounded-md bg-primary/80 hover:bg-primary">Créer votre espace</a>
</div>

@else
<div class="items-center hidden space-x-4 md:flex">  
  <a href="{{ route('dashboard') }}" class="px-4 py-2 text-white transition-all rounded-md bg-primary/80 hover:bg-primary">Mon espace</a>
</div>
@endguest
<!-- Version mobile -->
@else
<!-- L'utilisateur  pas connecté -->
@guest
<div class="px-2 py-4 border-t border-gray-200">
      
  <div class="flex items-center justify-between">
    <a href="{{ route('login') }}" class="transition-all text-muted-foreground hover:text-primary">Se connecter</a>
      <a href="{{ route('dashboard') }}" class="px-4 py-2 text-white transition-all rounded-md bg-primary/80 hover:bg-primary">Créer votre espace</a>
  </div>
</div>
@else
<!-- L'utilisateur est connecté -->
<div class="px-2 py-4 border-t border-gray-200">
      
  <div class="flex items-center justify-between">      
      <a href="{{ route('dashboard') }}" class="px-4 py-2 text-white transition-all rounded-md bg-primary/80 hover:bg-primary">Mon espace</a>
  </div>
</div>
@endguest
@endif
