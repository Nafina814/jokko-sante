<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        if (config('app.env') === 'production') {
            URL::forceScheme('https');

            // ShipiiX gère SESSION_DOMAIN automatiquement et le met à un
            // hostname interne, ce qui casse les cookies entre requêtes.
            // On force le domaine à null pour que le cookie soit valide
            // sur tout le domaine de l'app.
            config(['session.domain' => null]);
        }
    }
}
