<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications_transaction_types', function (Blueprint $table) {
            $table->id();
            $table->integer('publication_id')->unsigned();
            $table->integer('transaction_type_id')->unsigned();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();

            $table->foreign('publication_id')->references('id')->on('publications')->onDelete('cascade');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_types')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications_transaction_types');
    }
}
