<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItemSoldPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function(Blueprint $table){
            $table->float('acquire_price');
            $table->float('sold_price');
            $table->timestamp('displayed_at')->nullable();
            $table->timestamp('delivered_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function(Blueprint $table){
            $table->dropColumn('acquire_price');
            $table->dropColumn('sold_price');
            $table->dropColumn('displayed_at');
            $table->dropColumn('delivered_at');

        });
    }
}
