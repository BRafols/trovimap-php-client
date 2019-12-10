<?php

namespace Trovimap\Models;

use Illuminate\Database\Eloquent\Model;

class TrovimapEvaluation extends Model {

    protected $fillable = [
        'trovimap_id',
        'trovi_value',
        'trovi_rent_value',
        'surface_useful',
        'bedrooms',
        'bathrooms',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];

}