<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function( $table ){
            $table->increments('id');
            $table->string('fname', 50);
            $table->string('lname', 50);
            $table->integer('age')->unsigned();
            $table->string('phone', 20);
            $table->string('mobile', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
