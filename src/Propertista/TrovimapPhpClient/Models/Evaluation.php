<?php

namespace Trovimap\Propertista\TrovimapPhpClient\Models;

class PriceHistory
{
    public $Date; //Date
    public $Price; //int
}

class PhotosObj
{
    public $Path; //String
    public $Path_320x0; //String
}

class Comparable
{
    public $Sysid; //String
    public $location; //Location
    public $Bedrooms; //int
    public $Bathrooms; //int
    public $Description; //String
    public $LivingArea; //int
    public $Price; //int
    public $Locality; //String
    public $Type; //int
    public $SubType; //int
    public $PhotoUrl; //String
    public $PhotoUrl_320x0; //String
    public $ParcelCode; //String
    public $DisplayNeighborhood; //String
    public $PriceHistory; //array(PriceHistory)
    public $ListingDate; //Date
    public $PriceM2; //double
    public $YearBuilt; //String
    public $DisplayFullStreetAddress; //String
    public $distance; //double
    public $Pool; //int
    public $ParkingType; //int
    public $ViewType; //int
    public $PhotosObj; //array(PhotosObj)
    public $Polygons; //int
    public $Elevator; //bool?
    public $Terrace; //bool?
}

class Poi
{
    public $Type; //String
    public $Location; //Location
    public $Name; //String
    public $Distance; //double
    public $SubType; //String
    public $Fulladdress; //String
    public $Email; //String
    public $Telephone; //String
}

class Pricem2
{
    public $avg; //double
}

class Aggregation
{
    public $date; //Date
    public $pricem2; //Pricem2
}

class HistoricalStats
{
    public $aggregations; //array(Aggregation)
}

class Evaluation
{
    public $id; //int
    public $troviValue; //int
    public $troviRent; //int
    public $comparables; //array(Comparable)
    public $soldComparables; //array(Object)
    public $poi; //array(Poi)
    public $historicalStats; //HistoricalStats

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
