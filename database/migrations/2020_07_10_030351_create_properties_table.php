<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('code')->nullable();
            $table->string('address')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('property_type_id')->unsigned();
            $table->integer('neighborhood_id')->unsigned();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->bigInteger('user_owner_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('property_type_id')->references('id')->on('property_types');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
            $table->foreign('user_owner_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('properties');
    }
}
