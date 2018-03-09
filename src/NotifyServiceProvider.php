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

         $this->mergeConfigFrom(
             __DIR__ . '/Config/Notify.php', 'Notify'
        );

    }
}
