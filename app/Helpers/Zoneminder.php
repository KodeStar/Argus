<?php

namespace App\Helpers;

use App\Helpers\Contracts\CameraContract;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Helpers\Camera as Camera;

class Zoneminder implements CameraContract
{
    /**
     * Gets JSON feed from backend and turns into PHP array
     * @return array
     */
    public function getFeed()
    {
        $demo = env('DEMO', false);
        $backend = env('BACKEND_LOCATION');

        if($demo) { // return early with a demo JSON file
            return json_decode(file_get_contents('../resources/assets/camera.json'));
        }

        $client = new Client(); //GuzzleHttp\Client
        $response = $client->get(
            $backend.'/zm/api/monitors.json', 
                [
                    //'auth' =>  ['user', 'pass']
                ]
            );
        if($response->getStatusCode() === 200) {
            $body = $response->getBody();
            return json_decode($body);
        }

        return [];
    }

    /**
     * List all cameras
     * @return array Returns an array of Camera objects
     */
    public function list()
    {
        $output = [];

        $cameras = $this->getFeed();

        foreach($cameras->monitors as $camera) {
            //print_r($camera);
            $output[] = new Camera([
                'id' => $camera->Monitor->Id,
                'name' => $camera->Monitor->Name,
                'feed' => $camera->Monitor->Path,
            ]);

        }

        return $output;
    }
    public function single() {}
}