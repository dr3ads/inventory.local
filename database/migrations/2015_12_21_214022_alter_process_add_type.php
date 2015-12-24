<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProcessAddType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processes', function(Blueprint $table){
            $table->enum('type', array('pawn','renew', 'claim'))->after('ctrl_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('processes', function(Blueprint $table){
            $table->dropColumn('type');
        });
    }
}
