<?php

namespace App\Helpers\Contracts;

Interface CameraContract
{

    /**
     * Interface must provide a list of cameras
     * @return array of cameras
     */
    public function list();

    /**
     * Interface should provide a way to add a camera
     * @param string $key     Identifier for the camera
     * @param string $name    Name of camera
     * @param string $feed    Location of feed
     * @param string $preview Location to view preview feed
     * @param boolean $status  Status of camera
     */
    public function add($key, $name, $feed, $preview, $status);

}