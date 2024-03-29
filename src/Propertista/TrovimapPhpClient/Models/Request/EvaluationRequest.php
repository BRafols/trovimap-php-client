<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models\Request;

use JsonSerializable;
use ReflectionClass;
use ReflectionProperty;
use Trovimap\Propertista\TrovimapPhpClient\Exceptions\EvaluationRequestNotValidException;

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

    protected $requiredFields = [
        "ApartmentId",
        "ParcelId",
        "LivingArea",
        "Location"
    ];

    public function __construct(array $data) {
        if(!$this->isValid($data)) {
            throw new EvaluationRequestNotValidException();
        }
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function jsonSerializeV2()
    {
        return array_filter(get_object_vars($this), function($value) {
            return !is_null($value) && $value !== '';
        });
    }

    public function jsonSerialize()
    {
        $reflect = new ReflectionClass($this);
        $props   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC);
        $values = [];

        array_walk($props, function($property) use (&$values) {

            if (!is_null($this->{$property->name}) && $this->{$property->name} !== '') {
                $values[$property->name] = $this->{$property->name};
            }
        });

        return $values;
        
    }

    private function isValid($data) {
        return count(array_filter($this->requiredFields, function($field) use ($data) {
            return !array_key_exists($field, $data) || is_null($data[$field]);
        })) === 0;
    }
}