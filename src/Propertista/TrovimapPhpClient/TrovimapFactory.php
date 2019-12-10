<?php

namespace Trovimap\Propertista\TrovimapPhpClient;

use GuzzleHttp\Client;
use Phpfastcache\Helper\Psr16Adapter;

class TrovimapFactory {

    public static function create() {

        $token = '8lj7U8I4Bx';

        $client = new Client([
            'base_uri' => 'https://demo.trovimap.com/api/v2/',
            'headers' => [
                'X-Trovimap-Token' => $token
            ],
            'proxy' => '18.197.96.203:3128',
        ]);
        
        $defaultDriver = 'Files';
        $cacheDriver = new Psr16Adapter($defaultDriver);        

        return new Trovimap($client, $cacheDriver);
    }

}