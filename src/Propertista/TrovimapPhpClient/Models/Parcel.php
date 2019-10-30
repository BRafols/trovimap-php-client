<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class Parcel extends BaseModel {
    public $Id; //String
    public $Location; //Location
    public $DistrictId; //int
    public $CityId; //int
    public $StreetName; //String
    public $StreetType; //String
    public $StreetNumber; //String
    public $Province; //String
    public $City; //String

    public function __construct(array $data) {
        parent::__construct($data);

        $this->Location = new Location($data['Location']);
    }
}