<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class Characteristic
{
    public $ApartmentId; //String
    public $ParcelId; //String
    public $CadastralReference; //String
    public $LivingArea; //int
    public $Location; //Location

    public function __construct(array $data) {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}