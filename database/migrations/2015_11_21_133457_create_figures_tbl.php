<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiguresTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting', function(Blueprint $table){
            $table->increments('id');
            $table->float('amount');
            $table->string('accountable_type');
            $table->integer('accountable_id')->unsigned();
            $table->enum('type',['debit','credit']);
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
        Schema::drop('accounting');
    }
}
