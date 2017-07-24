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
        $data['cameras'] = Camera::all();
        return view('home', $data);
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


        if(!Setting::databaseReady()) $this->createDatabase();

        $backend = new Setting;
        $backend->key = 'backend';
        $backend->value = $request->input('backend');
        $backend->save();
        $backend_location = new Setting;
        $backend_location->key = 'backend_location';
        $backend_location->value = $request->input('backend_location');
        $backend_location->save();
        $backend_location = new Setting;
        $backend_location->key = 'backend_username';
        $backend_location->value = $request->input('backend_username');
        $backend_location->save();
        $backend_location = new Setting;
        $backend_location->key = 'backend_password';
        $backend_location->value = $request->input('backend_password');
        $backend_location->save();
        $backend_location = new Setting;
        $backend_location->key = 'view';
        $backend_location->value = 'view1';
        $backend_location->save();

        Camera::populate($camera->list());

        return redirect('/');
    }

    public function add($step=false)
    {
        //die(print_r(Camera::scan_range()));
        $data = [];
        switch($step) {
            case 'manual':
                return view('cameras/manual', $data);
                break;
            case 'scan':
                $data['range'] = Camera::scan_range();
                return view('cameras/scan', $data);
                break;
            default:
                return view('cameras/add', $data);
                break;
        }
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

    public function nextView()
    {
        $view = Setting::where('key', 'view')->first();
        //print_r($view);
        $current = $view->value;
        $possible_views = $this->possibleViews();
        $keys = array_keys($possible_views);
        $search = array_search($current,$keys);
        $next = isset($keys[$search+1]) ? $keys[$search+1] : 'view1';
       // var_dump($next);
        $view->value = $next;
        $view->save();
        return $next;
    }

    public function getNextView()
    {
        $this->nextView();
        return back();
    }


    protected function possibleViews()
    {
        return [
            'view1' => 'List',
            'view2' => '2 by 2',
            'view3' => '4 x 4',
        ];
    }

    


    //
}
