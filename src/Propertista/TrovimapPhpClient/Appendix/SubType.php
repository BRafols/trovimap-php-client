<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Appendix;

use Exception;
use Trovimap\Propertista\TrovimapPhpClient\Exceptions\InvalidSubTypeException;

class SubType {

    private $type = null;

    public static $types = [
        '1' => 'Apartment',
        '6' => 'Duplex',
        '8' => 'ManufacturedHome',
        '9' => 'MobileHome',
        '12' => 'Quadruplex',
        '13' => 'SingleFamilyAttached',
        '14' => 'SingleFamilyDetached',
        '18' => 'Triplex',
        '19' => 'Loft',
        '21' => 'SingleFamily',
        '22' => 'CountryHouse',
        '32' => 'PentHouse',
        '33' => 'GroundFloor',
        '36' => 'House',
        '37' => 'BelowGround',
        '43' => 'MultiFamil',
    ];

    public function __construct($id) {

        if (!$this->valid($id)) {
            throw new InvalidSubTypeException();
        }

        $this->type = $id;

    }

    public function __toString()
    {
        return self::$types[$this->type];
    }

    private function valid($id) {
        return in_array($id, array_keys(self::$types));
    }
}