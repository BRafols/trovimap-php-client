<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class BuildingUnit extends BaseModel
{
    public $Id; //String
    public $BuildingUnitId; //String
    public $ParcelId; //String
    public $YearBuilt; //String
    public $Apartments = []; //array(Object)

    public function __construct(array $data) {

        parent::__construct($data);

        foreach ($data['Apartments'] as $apartment) {
            array_push($this->Apartments, new Apartment($apartment));
        }
    }
}