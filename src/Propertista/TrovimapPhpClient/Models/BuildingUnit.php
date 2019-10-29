<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class BuildingUnit
{
    public $Id; //String
    public $BuildingUnitId; //String
    public $ParcelId; //String
    public $YearBuilt; //String
    public $Apartments; //array(Object)

    public function __construct(array $data) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }

        foreach ($data['Apartments'] as $apartment) {
            array_push($this->Apartments, new Apartment($apartment));
        }
    }
}