<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function($table){
            $table->increments('id');
            $table->string('ctrl_number');
            $table->integer('customer_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->float('pawn_amount')->unsigned();
            $table->datetime('renewed_at')->nullable();
            $table->datetime('expired_at')->nullable();
            $table->timestamps();

            //foreign keys
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('processes');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
