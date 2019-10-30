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
    public $comparables = []; //array(Comparable)
    public $soldComparables = []; //array(Object)
    public $poi = []; //array(Poi)
    public $historicalStats = []; //HistoricalStats

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (is_scalar($value)) {
                $this->{$key} = $value;
            }
        }

        foreach ($data['comparables'] as $comparable) {
            array_push($this->comparables, new Comparable($comparable));
        }

        foreach ($data['poi'] as $poi) {
            array_push($this->poi, new Poi($poi));
        }

        $this->historicalStats = $data['historicalStats'];
    }
}
