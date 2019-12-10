<?php

namespace Trovimap\Propertista\TrovimapPhpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Trovimap\Exception\AddressNotFoundException;
use Trovimap\Exception\CadastralReferenceNotFoundException;
use Trovimap\Exception\EvaluationException;
use Trovimap\Exception\PermissionErrorException;
use Trovimap\Propertista\TrovimapPhpClient\Models\BuildingUnit;
use Trovimap\Propertista\TrovimapPhpClient\Models\Characteristic;
use Trovimap\Propertista\TrovimapPhpClient\Models\Evaluation;
use Trovimap\Propertista\TrovimapPhpClient\Models\Parcel;
use Trovimap\Propertista\TrovimapPhpClient\Models\Request\EvaluationRequest;

class Trovimap {
    
    const ADDRESS_NOT_FOUND = 'no_such_address';
    const CADASTRAL_NOT_FOUND = 'cadastrial_reference_invalid';
    const PERMISSION_ERROR = 'permission_error';

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
            if ($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody()->getContents());

                if ($response->error === static::ADDRESS_NOT_FOUND) {
                    throw new AddressNotFoundException();
                } else if ($response->error === static::PERMISSION_ERROR) {
                    throw new PermissionErrorException();
                }
                
                dd(stream_get_contents($response->getBody()));
            }
            dd($e->getResponse()->getBody());
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

            return new BuildingUnit($data[0]);
        } catch (ClientException $e) {
            dd(json_decode($e->getResponse()->getBody()));
        }
    }

    public function getBuildingUnitByCadastralReference(string $reference) {
        
        $uri = 'cma/free/parcel/by-cadastral/' . $reference . '/building';
        
        try {
            $response = $this->client->get($uri);            
            
            $data = json_decode($response->getBody(), true);

            return new BuildingUnit($data[0]);
        } catch (ClientException $e) {
            if ($e->hasResponse()) {
                $response = json_decode($e->getResponse()->getBody()->getContents());
                if ($response->error === static::CADASTRAL_NOT_FOUND) {
                    throw new CadastralReferenceNotFoundException();
                } else if ($response->error === static::PERMISSION_ERROR) {
                    throw new PermissionErrorException();
                } else {
                    throw $e;
                }
            }
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
                    'body' => json_encode($data, JSON_NUMERIC_CHECK),
                ]);
                
                $data = json_decode($response->getBody(), true);

                $this->cacheDriver->set($hash, $data, 30000);// 5 minutes
            } else {
                // Getter action
                $data = $this->cacheDriver->get($hash);
            }

            return new Evaluation($data);
        } catch (ClientException $e) {
            throw new EvaluationException();
        } catch (ServerException $e) {
            throw new EvaluationException();
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
        $uri = 'cma/free/evaluation/' . $buildingUnitId . '/download-report';

        $response = $this->client->get($uri, ['save_to' => $path]);

        return $response;
    }

}