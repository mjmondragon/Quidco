<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ServiceGifInterface;
use App\Services\ServiceGiphy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ServiceGifInterface::class, function($app){
            return new ServiceGiphy();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
