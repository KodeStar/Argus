<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// List all created backends here
use App\Helpers\Zoneminder;

class CameraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\CameraContract', function(){
            $backend = env('BACKEND', 'zoneminder');
            switch($backend)
            {
                case 'zoneminder': return new Zoneminder();
                default: return new Zoneminder();
            }

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\Helpers\Contracts\CameraContract'];
    }

}
