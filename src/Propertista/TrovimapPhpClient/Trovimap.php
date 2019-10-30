<?php

namespace Trovimap\Propertista\TrovimapPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Trovimap\Propertista\TrovimapPhpClient\Models\BuildingUnit;
use Trovimap\Propertista\TrovimapPhpClient\Models\Characteristic;
use Trovimap\Propertista\TrovimapPhpClient\Models\Evaluation;
use Trovimap\Propertista\TrovimapPhpClient\Models\Parcel;
use Trovimap\Propertista\TrovimapPhpClient\Models\Request\EvaluationRequest;

class Trovimap {
    
    private $client;
    private $cacheDriver;

    public function __construct(Client $client, $cacheDriver)
    {
        $this->client = $client;
        $this->cacheDriver = $cacheDriver;
    }

    /**
     * 
     */
    public function getParcelByAddress(string $address) {

        try {

            $hash = md5($address);
            if (!$this->cacheDriver->has($hash)) {
            
                $response = $this->client->get('cma/free/parcel', [
                    'query' => [
                        'address' => $address
                    ]
                ]);
                
                $data = json_decode($response->getBody(), true);
            
                $this->cacheDriver->set($hash, $data, 30000);// 5 minutes

            } else {
                // Getter action
                $data = $this->cacheDriver->get($hash);
            }

            return array_map(function($element) {
                return new Parcel($element);
            }, $data);
        } catch (ClientException $e) {
            dd(json_decode($e->getResponse()->getBody()));
        }
    }

    public function getBuildingUnitByParcelId(string $parcelId) {
        
        $uri = 'cma/free/parcel/' . $parcelId . '/building';
        
        try {

            $hash = md5($uri);
            if (!$this->cacheDriver->has($hash)) {
                $response = $this->client->get($uri);
            
                $data = json_decode($response->getBody(), true);
                
                $this->cacheDriver->set($hash, $data, 30000);// 5 minutes
            } else {
                // Getter action
                $data = $this->cacheDriver->get($hash);
            } 

            return array_map(function($buildingUnit) {
                return new BuildingUnit($buildingUnit);
            }, $data);
        } catch (ClientException $e) {
            dd(json_decode($e->getResponse()->getBody()));
        }
    }

    public function getBuildingUnitByCadastralReference(string $reference) {
        
        $uri = 'cma/free/parcel/by-cadastral/' . $reference . '/building';
        
        try {
            $response = $this->client->get($uri);
            
            $data = json_decode($response->getBody(), true);

            return array_map(function($buildingUnit) {
                return new BuildingUnit($buildingUnit);
            }, $data);
        } catch (ClientException $e) {
            dd(json_decode($e->getResponse()->getBody()));
        }
    }

    public function getCharacteristics(string $parcelId) {
        $uri = 'cma/free/apartment/' . $parcelId . '/characteristics';

        try {
            $response = $this->client->get($uri);
            
            $data = json_decode($response->getBody(), true);

            return new Characteristic($data);
        } catch (ClientException $e) {
            dd(json_decode($e->getResponse()->getBody()));
        }
    }

    public function evaluate(string $buildingUnitId, EvaluationRequest $data) {
        $uri = 'cma/free/apartment/' . $buildingUnitId . '/evaluate/comparables';

        $hash = md5(json_encode([
            $uri, 
            $data
        ]));
        // $uri = 'https://demo.trovimap.com/api/v2/cma/free/apartment/8_900_1213625DF3811C_001_10/evaluate/comparables';
        try {
            if(!$this->cacheDriver->has($hash)){

                $response = $this->client->post($uri, [
                    'body' => json_encode($data),
                ]);
                
                $data = json_decode($response->getBody(), true);

                $this->cacheDriver->set($hash, $data, 30000);// 5 minutes
            } else {
                // Getter action
                $data = $this->cacheDriver->get($hash);
            }

            return new Evaluation($data);
        } catch (ClientException $e) {
            dd($e->getResponse());
            dd(json_decode($e->getResponse()->getBody()));
        } catch (ServerException $e) {
            dd($e);
        }
    }

    /**
     * Undocumented function
     *
     * @param string $buildingUnitId
     * @param [type] $path
     * @return void
     */
    public function download(string $buildingUnitId, $path) {
        $uri = 'cma/free/apartment/' . $buildingUnitId . '/evaluate/comparables';

        $response = $this->client->get($uri, ['save_to' => $path]);

        return $response;
    }

}