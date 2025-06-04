<?php

namespace PPZ\S3Service;

use Illuminate\Support\ServiceProvider;

class PPZS3ServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('ppzs3service', function ($app) {
            return new PPZS3Service();
        });

        $this->mergeConfigFrom(__DIR__.'/../config/s3service.php', 's3service');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/s3service.php' => config_path('s3service.php'),
        ], 's3service-config');
    }
}