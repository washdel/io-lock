<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Http\HttpClientOptions;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('firebase.factory', function () {
            $serviceAccountPath = config_path('firebase_credentials.json');
            
            return (new Factory)
                ->withServiceAccount($serviceAccountPath)
                ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
                ->withHttpClientOptions(
                    HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
                );
        });

        $this->app->singleton('firebase.database', function () {
            return app('firebase.factory')->createDatabase();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}