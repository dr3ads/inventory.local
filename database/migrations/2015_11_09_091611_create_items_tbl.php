<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function($table){
            $table->increments('id');
            $table->string('name',50);
            $table->string('brand');
            $table->string('serial');
            $table->text('description');
            $table->float('value');
            $table->float('selling_value');
            $table->boolean('is_onhand')->default(true);
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('items');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
