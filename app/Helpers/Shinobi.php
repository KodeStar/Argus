<?php

namespace App\Helpers;

use App\Helpers\Contracts\CameraContract;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Camera as Camera;
use App\Setting as Setting;

class Shinobi implements CameraContract
{
    /**
     * Gets JSON feed from backend and turns into PHP array
     * @return array
     */
    public function getFeed()
    {
        $backend = Setting::value('backend_location');
        $api_key = Setting::value('api_key');
        $group = Setting::value('group');

        $client = new Client(); //GuzzleHttp\Client
        $response = $client->get(
            $backend.'/shinobi/api/monitors.json', 
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
        $demo = env('DEMO', false);
        $output = [];

        $cameras = $this->getFeed();

        foreach($cameras->monitors as $camera) {
            //print_r($camera);
            $backend = Setting::value('backend_location');
            $preview = $backend.'/zm/cgi-bin/nph-zms?mode=jpeg&scale=100&maxfps=4&monitor='.$camera->Monitor->Id;
            if($demo) $preview = '/img/camera1.png';
            $output[] = [
                'key' => $camera->Monitor->Id,
                'name' => $camera->Monitor->Name,
                'feed' => $camera->Monitor->Path,
                'preview' => $preview,
                'status' => $camera->Monitor->Enabled
            ];

        }

        return $output;
    }
    public function add() {}
}