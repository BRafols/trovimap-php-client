<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class Characteristics
{
    public $Location; //Location
}

class Apartment extends BaseModel
{
    public $Id; //String
    public $FormattedAddress; //String
    public $StreetName; //String
    public $StreetNumber; //String
    public $Floor; //String
    public $Door; //String
    public $Scale; //String
    public $YearBuilt; //String
    public $CadastralReference; //String
    public $LivingArea; //int
    public $Type; //int
    public $Characteristics; //Characteristics

    public function __construct(array $data)
    {
        parent::__construct($data);
        foreach ($data['Characteristics'] as $key => $value) {
            $this->Characteristics[$key] = $value;
        }
    }
}
