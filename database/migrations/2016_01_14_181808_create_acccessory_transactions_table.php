<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcccessoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory_transactions', function(Blueprint $table){
            $table->increments('id');
            $table->integer('accessory_id')->unsigned();
            $table->enum('type', array('in','out'));
            $table->float('amount');
            $table->integer('quantity')->unsigned();
            $table->text('description');
            $table->timestamps();

            $table->foreign('accessory_id')->references('id')->on('accessories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accessory_transactions');
    }
}
