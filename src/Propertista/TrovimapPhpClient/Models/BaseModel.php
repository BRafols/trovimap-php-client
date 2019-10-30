<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class BaseModel {

    public function __construct(array $data)
    {

        
        foreach ($data as $key => $value) {
            if (is_scalar($value) && property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

}