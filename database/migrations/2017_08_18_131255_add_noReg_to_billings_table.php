<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNoRegToBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->integer('formujiriksa_id')->unsigned()->nullable();

            $table->foreign('formujiriksa_id')->references('id')->on('formujiriksas')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billings', function (Blueprint $table) {
            $table->dropForeign('billings_formujiriksa_id_foreign');
            $table->dropColumn('formujiriksa_id');
        });
    }
}
