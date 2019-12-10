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
        Schema::table('property', function (Blueprint $table) {
            $table->integer('trovimap_evaluation_id')->nullable()->unsigned();
            $table->foreign('trovimap_evaluation_id')->references('id')->on('trovimap_evaluations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down() {
        Schema::table('property', function (Blueprint $table) {
            $table->dropColumn('trovimap_evaluation_id');
        });
    }
}