<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFotoAlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('terakhir_service')->default('null.png');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
}
