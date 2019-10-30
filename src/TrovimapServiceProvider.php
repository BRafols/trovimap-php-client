<?php

namespace Trovimap;

use Illuminate\Support\ServiceProvider;

class TrovimapServiceProvider extends ServiceProvider {

    public function boot() {
        $this->registerResources();
        $this->registerRoutes();
    }

    public function register() {

    }

    private function registerResources() {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'trovimap');
    }

    private function registerRoutes() {
        Route::group([], function() {
            $this->loadRoutesFrom(__DIR__ . '/../routes/app.php');
        });
    }
}