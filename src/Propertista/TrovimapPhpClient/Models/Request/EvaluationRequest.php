<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models\Request;

use JsonSerializable;

class EvaluationRequest implements JsonSerializable {
    public $ApartmentId; //String
    public $ParcelId; //String
    public $CadastralReference; //String
    public $Bathrooms; //int
    public $Bedrooms; //int
    public $Commodity; //array(int)
    public $Elevator; //boolean
    public $FrontageType; //int
    public $LivingArea; //int
    public $Location; //Location
    public $LotSize; //int
    public $Orientation; //int
    public $ParkingType; //int
    public $Pool; //int
    public $PurchaseAmount; //int
    public $PurchaseConservation; //int
    public $PurchaseDate; //String
    public $RefurbishAmount; //int
    public $RefurbishConservation; //int
    public $RefurbishDate; //String
    public $SubType; //int
    public $Type; //int
    public $ViewType; //String

    public function __construct(array $data) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this), function($value) {
            return !is_null($value) && $value !== '';
        });
    }
}