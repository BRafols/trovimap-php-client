<?php

namespace Trovimap;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Trovimap\Propertista\TrovimapPhpClient\Trovimap;
use Trovimap\Propertista\TrovimapPhpClient\TrovimapFactory;

class TrovimapServiceProvider extends ServiceProvider {

    public function boot() {
        $this->registerResources();
        $this->registerRoutes();
        $this->publishConfiguration();
        $this->publishes([
            __DIR__ . './../database/migrations', database_path('migrations/')
        ], 'trovimap');
    }

    public function register() {
        $this->app->singleton(Trovimap::class, function ($app) {
            return TrovimapFactory::create();
        });

        
        $this->mergeConfigFrom(
            __DIR__.'/config/trovimap.php', 'trovimap'
        );
    }

    private function registerResources() {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'trovimap');
    }

    private function registerRoutes() {
        /**
         * Test
         */
        Route::group($this->routeConfiguration(), function() {
            $this->loadRoutesFrom(__DIR__ . '/../routes/app.php');
        });
    }

    private function routeConfiguration() {
        return [
            'prefix' => 'trovi',
        ];
    }

    private function publishConfiguration() {
        $this->publishes([
            __DIR__.'/config/trovimap.php' => config_path('trovimap.php'),
        ], 'trovimap');
    }
}