<?php

namespace App\Helpers;

use App\Helpers\Contracts\CameraContract;
use App\Camera as Camera;
use App\Setting as Setting;

class Argus implements CameraContract
{

    /**
     * List all cameras
     * @return array Returns an array of Camera objects
     */
    public function list()
    {
        $output = [];

        return $output;
    }
    public function add($key, $name, $feed, $preview, $status) 
    {
    }

}