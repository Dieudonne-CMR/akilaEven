<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use App\Helpers\ToastHelper;
use App\Helpers\BookingStatusHelper;
use App\Helpers\BookingFilterHelper;
use App\Helpers\InitialsHelper;
use App\Helpers\AgenceStatsHelper;

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
        
        // Enregistrement du helper pour les statistiques d'agence
        $this->app->singleton('agence.stats', function () {
            return new AgenceStatsHelper();
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
        
        // Directive pour le badge de statut de réservation
        Blade::directive('bookingStatus', function ($expression) {
            return "<?php echo \App\Helpers\BookingStatusHelper::getStatusBadge($expression); ?>";
        });
        
        // Directive pour les initiales
        Blade::directive('initials', function ($expression) {
            return "<?php echo \App\Helpers\InitialsHelper::generate($expression); ?>";
        });
        
        // Directive pour le badge d'avatar avec initiales
        Blade::directive('avatarBadge', function ($expression) {
            return "<?php echo \App\Helpers\InitialsHelper::avatarBadge($expression); ?>";
        });
        
        // Directive pour afficher les services d'un agence sous forme de tags
        Blade::directive('agenceServices', function ($expression) {
            return "<?php
                \$services = is_array($expression) ? $expression : json_decode($expression, true);
                if (\$services && count(\$services) > 0) {
                    echo '<div class=\"flex flex-wrap gap-2 mt-4\">';
                    foreach (\$services as \$service) {
                        echo '<span class=\"px-2 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300\">' . \$service . '</span>';
                    }
                    echo '</div>';
                }
            ?>";
        });
    }
}
