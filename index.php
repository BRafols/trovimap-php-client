<?php

use Trovimap\Propertista\TrovimapPhpClient\Models\Request\EvaluationRequest;
use Trovimap\Propertista\TrovimapPhpClient\TrovimapFactory;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/helpers.php';

$client = TrovimapFactory::create();

$parcels = $client->getParcelByAddress('Passatge Escudellers, 7, 08002, Barcelona');

$parcel = $parcels[0];

// $buildingUnits = $client->getBuildingUnitByParcelId($parcel->Id);
// $buildingUnits = $client->getBuildingUnitByCadastralReference('1213625DF3811C0009ZX');

// dd($buildingUnits[0]->Apartments[0]);

// dd($parcels);

$apartmentId = '28_900_0853212VK4705D_001_9';
$request = new EvaluationRequest([
    'ApartmentId' => '8_900_1213625DF3811C_001_10',
    'ParcelId' => '8_900_1213625DF3811C_0001',
    'LivingArea' => 165,
    'Location' => [
      'lat' => 41.65091378890275,
      'lon' => -0.9066963722045938
    ]
]);


dd($client->evaluate($apartmentId, $request));