<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProcessTblAddClaimedAtField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('processes', function($table){
            $table->timestamp('pawned_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('claimed_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('processes', function($table){
            $table->dropColumn('pawned_at');
            $table->dropColumn('claimed_at');
        });
    }
}
