<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_owner_id')->unsigned();
            $table->bigInteger('user_customer_id')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->integer('transaction_type_id')->unsigned();
            $table->float('value');
            $table->integer('currency_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_owner_id')->references('id')->on('users');
            $table->foreign('user_customer_id')->references('id')->on('users');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreign('currency_id')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transactions');
    }
}
