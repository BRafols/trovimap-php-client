<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrovimapEvaluationTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('trovimap_evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trovimap_id')->unsigned();
            $table->integer('trovi_value')->unsigned();
            $table->integer('trovi_rent_value')->unsigned();
            $table->integer('surface_useful')->unsigned();
            $table->integer('bedrooms')->unsigned();
            $table->integer('bathrooms')->unsigned();
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('trovimap_evaluations');
    }
}