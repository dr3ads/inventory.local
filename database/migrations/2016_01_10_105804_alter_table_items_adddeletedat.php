<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableItemsAdddeletedat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->softDeletes();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->timestamp('sold_at')->nullable();

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
        Schema::table('items', function ($table) {
            $table->dropColumn('deleted_at');
            $table->dropColumn('sold_at');
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->dropForeign('items_customer_id_foreign');
            $table->dropColumn('customer_id');

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        });
    }
}
