<?php

namespace App\Helpers;

use App\Helpers\Contracts\CameraContract;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use App\Camera as Camera;
use App\Setting as Setting;

class Zoneminder implements CameraContract
{



    /**
     * Gets JSON feed from backend and turns into PHP array
     * @return array
     */
    public function getFeed($try=0, $client = false)
    {
        
        $demo = env('DEMO', false);
        $backend = Setting::get_value('backend_location');
        $user = Setting::get_value('backend_username');
        $pass = Setting::get_value('backend_password');

        if($demo) { // return early with a demo JSON file
            return json_decode(file_get_contents('../resources/assets/camera.json'));
        }
        //$client = new Client(); //GuzzleHttp\Client
        $cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
        //$cookieJar = new CookieJar();
        if($client === false) {
            $client = new Client(['cookies' => $cookieJar]);
        }

        try {
            $response = $client->request('GET', 
                $backend.'/zm/api/monitors.json'
            );
            if($response->getStatusCode() === 200) {
                //echo "here1 - ".$response->getBody();
                $body = $response->getBody();
                //die(print_r(json_decode($body)));
                return json_decode($body);
            }

      
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if($e->getResponse()->getStatusCode() === 401) {
                //echo "not authed ".$user." ".$pass." - ";
                if($try <= 2) {
                    $response = $client->request('GET', 
                        $backend.'/zm/index.php', 
                        [
                            'query' =>  ['username' => $user, 'password' => $pass, 'action' => 'login', 'view' => 'console']
                        ]
                    );
                        //$response->getStatusCode()." -- ".$response->getBody();
                        //die();
                    $try++;

                    return $this->getFeed($try, $client);
                }

            } else {
                echo 'Caught response: ' . $e->getResponse()->getStatusCode();
            }
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
        //die(print_r($cameras));
        $backend = Setting::get_value('backend_location');

        foreach($cameras->monitors as $camera) {
            //print_r($camera);
            $preview = $backend.'/zm/cgi-bin/nph-zms?mode=jpeg&scale=100&maxfps=4&monitor='.$camera->Monitor->Id;
            if($demo) $preview = '/img/camera1.png';

            $source = '';
            if ( $camera->Monitor->Type == "Local" ) {
              $source = $camera->Monitor->Device.' ('.$camera->Monitor->Channel.')';
            }
            if ( $camera->Monitor->Type == "Remote" ) {
              $source = $camera->Monitor->Host;
            } 
            if ( $camera->Monitor->Type == "File" || $camera->Monitor->Type == "cURL" ) {
              $source = preg_replace( '/^.*\//', '', $camera->Monitor->Path );
            } 
            if ( $camera->Monitor->Type == "Ffmpeg" || $camera->Monitor->Type == "Libvlc" ) {
              $domain = parse_url( $camera->Monitor->Path, PHP_URL_HOST );
              $source = $domain ? $domain : preg_replace( '/^.*\//', '', $camera->Monitor->Path );
            } 
            if ( $source == '' ) {
              $source = 'Monitor ' . $camera->Monitor->Id;
            }

            $output[] = [
                'key' => $camera->Monitor->Id,
                'name' => $camera->Monitor->Name,
                'feed' => $camera->Monitor->Path,
                'source' => $source,
                'preview' => $preview,
                'status' => $camera->Monitor->Enabled
            ];

        }

        return $output;
    }
    public function add($key, $name, $feed, $preview, $status) 
    {
        $data = [
            
        ];
        $this->addCameraToZoneminder($data);
    }

    protected function addCameraToZoneminder($data)
    {

    }
}