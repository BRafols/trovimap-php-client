<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class Poi extends BaseModel
{
    public $Type; //String
    public $Location; //Location
    public $Name; //String
    public $Distance; //double
    public $SubType; //String
    public $Fulladdress; //String
    public $Email; //String
    public $Telephone; //String

    public function __construct(array $data)
    {

        parent::__construct($data);

        $this->Location = new Location($data['Location']);
        
    }
}