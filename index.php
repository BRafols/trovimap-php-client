<?php

use Trovimap\Propertista\TrovimapPhpClient\Models\Comparable;
use Trovimap\Propertista\TrovimapPhpClient\Models\Request\EvaluationRequest;
use Trovimap\Propertista\TrovimapPhpClient\TrovimapFactory;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/helpers.php';

$client = TrovimapFactory::create();

$address = 'Passatge Escudellers, 7, 08002, Barcelona';
// $parcels = $client->getParcelByAddress($address);

$parcelId = 'SXBNaEJyVnc2aTM4cDRtMGVMR3hjcHRpK3N0VGFTOXhUNEZaRkt5azk3dWFJT1NRMVFIbHpxbnNPcktQY21QOG82ZkZobFZjTGFBdzkxejdYTi9WeEprNjg3UFdQd1JlOEVOVHpJbTducGFqSi9mSzRWOVc3V1FlSXc1dHBicUV0WHFPNnNUVmptOXBOWFBkVEMrNU1XVEtFakthbGJyV01ub2xUSzBYZWN3PQ==';
// $buildingUnits = $client->getBuildingUnitByParcelId($parcelId);

$apartmentId = '8_900_1213625DF3811C_001_6';
$data = $client->evaluate($apartmentId, new EvaluationRequest([
    'ApartmentId' => '8_900_1213625DF3811C_001_6',
    'ParcelId' => '8_900_1213625DF3811C_0001',
    'LivingArea' => 165,
    'Location' => [
        'lat' => 41.37892301375468,
        'lon' => 2.176777468274225
    ]
]));

array_walk($data->comparables, function($comp) {
    echo $comp->SubType;
});
dd($data);