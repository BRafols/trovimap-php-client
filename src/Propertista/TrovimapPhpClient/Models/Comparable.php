<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

use Trovimap\Propertista\TrovimapPhpClient\Appendix\SubType;

class Comparable extends BaseModel
{
    public $location; //Location
    public $Bathrooms; //int
    public $CurrencyCode; //String
    public $Title; //Title
    public $Category; //int
    public $ListingDate; //String
    public $DisplayFullStreetAddress; //String
    public $Price; //int
    public $LivingArea; //int
    public $SellerType; //int
    public $YearBuilt; //String
    public $PhotoUrl; //String
    public $SubType; //int
    public $DisplayZipcode; //String
    public $Bedrooms; //int
    public $PriceM2; //double
    public $Sysid; //String
    public $BrokerId; //String
    public $Url; //String
    public $PhotoUrl_320x0; //String
    public $distance; //double
    public $Type; //int
    public $ParcelCode; //String
    public $Description;
    public $Locality;
    public $DisplayNeighborhood;
    public $PriceHistory;
    public $Pool;
    public $ParkingType;
    public $ViewType;
    public $PhotosObj;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->location = new Location($data['location']);
        $this->SubType = new SubType($data['SubType']);
        $this->PhotosObj = $data['PhotosObj'];
    }
}