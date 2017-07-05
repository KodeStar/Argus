<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// List all created backends here
use App\Helpers\Zoneminder;
use App\Setting as Setting;

class CameraServiceProvider extends ServiceProvider
{

    public $available = [
        'zoneminder' => ['class' => 'Zoneminder', 'name' => 'ZoneMinder'],
        'shinobi' => ['class' => 'Shinobi', 'name' => 'Shinobi'],
        'argus' => ['class' => 'Argus', 'name' => 'Argus (Live stream only)'],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $view = (Setting::databaseReady()) ? Setting::get_value('view') : 'view1';
        view()->share('view', $view);
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
                $backend = Setting::get_value('backend');
            } else {
                $request = app(\Illuminate\Http\Request::class);
                if(null !== $request->input('backend')) $backend = $request->input('backend');
            }
            
            $available = $this->available;
            $interface = isset($available[$backend]['class']) ? $available[$backend]['class'] : 'Zoneminder';
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
