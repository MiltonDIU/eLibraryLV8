<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Service', 'App\Helpers\SettingsHelper');
        $loader->alias('FrontEnd', 'App\Helpers\FrontEndHelper');
        Paginator::useBootstrap();
    }
}
