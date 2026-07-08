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
            // ShipiiX termine TLS au niveau du proxy et envoie HTTP en interne.
            // Le flag Secure sur le cookie de session doit être false sinon
            // le navigateur ne renvoie jamais le cookie sur les requêtes internes HTTP.
            config(['session.secure' => false]);
        }
    }
}
