<?php

namespace App\Helpers;

class Camera {

    public $id = false;
    public $ip = false;
    public $name = false;
    public $feed = false;
    public $status = false;

    public function __construct($array)
    {
        extract($array);

        if(isset($id)) $this->id = $id;
        if(isset($ip)) $this->ip = $ip;
        if(isset($name)) $this->name = $name;
        if(isset($feed)) $this->feed = $feed;
        if(isset($status)) $this->status = $status;
    }
}