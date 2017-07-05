<?php

namespace App\Http\Controllers;

use App\Helpers\Contracts\CameraContract;
use Illuminate\Http\Request;
use App\Setting as Setting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Camera as Camera;

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

    public function dashboard()
    {
        if(!$this->databaseReady()) return redirect('setup');

        $data['cameras'] = Camera::all();
        return view('home', $data);
    }

    /**
     * Check if database is ready, if it isn't redirect user to setup page
     * @return boolean
     */
    public function databaseReady()
    {
        $path = base_path().'/database/database.sqlite';

        if(file_exists($path) && filesize($path) > 0) {
            return true;
        }
        return false;
    
    }

    /**
     * Setup page
     * @return void
     */
    public function setup()
    {
        $data = [];
        return view('setup', $data);
    }


    /**
     * Store setup details
     *
     * @param  Request  $request, CameraContract $camera
     * @return Response
     */
    public function storesetup(Request $request, CameraContract $camera)
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

        Camera::populate($camera->list());

        return redirect('/');
    }

    /**
     * Create the database
     * @return void
     */
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
