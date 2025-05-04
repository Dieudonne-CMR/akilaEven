<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Helpers\ToastHelper;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Enregistrement du helper pour les toasts
        $this->app->singleton('toast', function () {
            return new ToastHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Pour les anciens MySQL < 5.7.7 (facultatif si vous êtes sur une version récente de Laravel/MySQL)
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $navigation = config('navigation', []);
            
            // Liens front
            $links = $navigation['links'] ?? [];
            $view->with('globalNavigationLinks', array_map(
                fn(array $link) => array_merge($link, [
                    'is_active' => request()->routeIs(...($link['active'] ?? []))
                ]),
                $links
            ));
            
            // Liens admin
            $adminLinks = $navigation['admin_links'];
            $view->with('adminNavigationLinks', array_map(
                fn(array $link) => array_merge($link, [
                    'is_active' => request()->routeIs(...($link['active'] ?? []))
                ]),
                $adminLinks
            ));
            
        });

        // Ajout des directives Blade personnalisées
        Blade::directive('toast', function ($expression) {
            return "<?php echo view('components.ui.toast', $expression)->render(); ?>";
        });
    }
}
