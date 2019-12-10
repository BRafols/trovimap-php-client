<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'parcel'
], function() {
    Route::get('/', 'Trovimap\Http\Controllers\ParcelController@index');
    Route::get('/{id}', 'Trovimap\Http\Controllers\ParcelController@show');
    Route::get('/cadastral/{id}', 'Trovimap\Http\Controllers\ParcelController@showByCadastral');
});

Route::group([
    'prefix' => 'apartment/{id}'
], function() {
    Route::post('/', 'Trovimap\Http\Controllers\ApartmentController@show');
    Route::get('/characteristics', 'Trovimap\Http\Controllers\ApartmentController@characteristics');
});

Route::group([
    'prefix' => 'evaluation/{id}'
], function() {
    Route::get('/', 'Trovimap\Http\Controllers\EvaluationController@download');
});
