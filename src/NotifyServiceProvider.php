<?php

namespace Philexe\Notify;

use Illuminate\Support\ServiceProvider;
use App;

class NotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $this->publishes([
           __DIR__ . '/Config/Notify.php' => config_path('Notify.php'),
       ]);

       $this->publishes([
             __DIR__.'/assets'  => public_path('notify'),
       ], 'public');

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        App::bind('notify', function()
         {
             return new Notify;
         });

         $this->mergeConfigFrom( __DIR__ .'/Config/Notify.php', 'Notify');
         $this->loadViewsFrom(__DIR__.'/views', 'Notify');

    }
}
