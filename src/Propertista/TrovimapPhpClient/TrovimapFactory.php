<?php

namespace Trovimap\Propertista\TrovimapPhpClient;

use GuzzleHttp\Client;

class TrovimapFactory {

    public static function create() {

        $token = '8lj7U8I4Bx';

        $client = new Client([
            'base_uri' => 'https://demo.trovimap.com/api/v2/',
            'headers' => [
                'X-Trovimap-Token' => $token
            ]
        ]);

        return new Trovimap($client);
    }

}