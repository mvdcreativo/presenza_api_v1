<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('dni')->nullable();
            $table->string('phone')->nullable();
            $table->string('movil')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('company')->nullable();
            $table->string('cuit')->nullable();
            $table->string('image')->nullable();
            $table->string('type_doc_iden')->nullable();
            $table->string('role')->default("USER");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accounts');
    }
}
