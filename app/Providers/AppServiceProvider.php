<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $links = config('navigation.links');
            
            $view->with('globalNavigationLinks', array_map(function ($link) {
                $link['is_active'] = request()->routeIs($link['active'] ?? []);
                return $link;
            }, $links));
        });
        
        //
    }
}
