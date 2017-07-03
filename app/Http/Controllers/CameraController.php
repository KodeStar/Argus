<?php

namespace App\Http\Controllers;

use App\Helpers\Contracts\CameraContract;
use Illuminate\Http\Request;
use App\Setting as Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CameraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //die(phpinfo());
    }

    public function dashboard(CameraContract $camera)
    {
        if(!$this->databaseReady()) return redirect('setup');

        $data['cameras'] = $camera->list();
        return view('home', $data);
    }

    /**
     * Check if database is ready, if it isn't redirect user to setup page
     * @return [type] [description]
     */
    public function databaseReady()
    {
        $path = base_path().'/database/database.sqlite';

        if(file_exists($path) && filesize($path) > 0) {
            return true;
        }
        return false;
    
    }

    public function setup()
    {
        $data = [];
        return view('setup', $data);
    }


    /**
     * Store a new blog post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function storesetup(Request $request)
    {
        $this->validate($request, [
            'backend' => 'required',
            'backend_location' => 'required',
        ]);


        if(!$this->databaseReady()) $this->createDatabase();

        $backend = new Setting;
        $backend->key = 'backend';
        $backend->value = $request->input('backend');
        $backend->save();
        $backend_location = new Setting;
        $backend_location->key = 'backend_location';
        $backend_location->value = $request->input('backend_location');
        $backend_location->save();

        return redirect('/');
    }

    protected function createDatabase()
    {
        $path = base_path().'/database/database.sqlite';

        if(!file_exists($path)) {
            fopen($path, "w");
        }

        Artisan::call('migrate');
    }


    //
}
