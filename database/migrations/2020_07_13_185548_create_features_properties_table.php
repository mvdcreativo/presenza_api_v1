<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturesPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features_properties', function (Blueprint $table) {
            $table->id();
            $table->integer('feature_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->string('value')->nullable();
            $table->timestamps();

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('features_properties');
    }
}
