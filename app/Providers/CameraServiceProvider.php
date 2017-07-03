<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// List all created backends here
use App\Helpers\Zoneminder;
use App\Setting as Setting;

class CameraServiceProvider extends ServiceProvider
{

    public $available = [
        'zoneminder' => 'Zoneminder',
        'shinobi' => 'Shinobi'
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('available_backends', $this->available);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\CameraContract', function(){

            $path = base_path().'/database/database.sqlite';

            $backend = 'zoneminder';

            if(file_exists($path) && filesize($path) > 0) {
                $backend = Setting::value('backend');
            } else {
                $request = app(\Illuminate\Http\Request::class);
                if(null !== $request->input('backend')) $backend = $request->input('backend');
            }
            
            $available = $this->available;
            $interface = isset($available[$backend]) ? $available[$backend] : 'Zoneminder';
            $interface = "\App\Helpers\\".$interface;

            return new $interface();
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
