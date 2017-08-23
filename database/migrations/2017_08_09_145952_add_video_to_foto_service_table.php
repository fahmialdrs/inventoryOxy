<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoToFotoServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fotoservices', function (Blueprint $table) {
            $table->string('foto_tabung_service')->nullable()->change();
            $table->string('video_tabung_service')->nullable()->after('foto_tabung_service');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fotoservices', function (Blueprint $table) {
            $table->string('foto_tabung_service')->change();
            $table->dropColumn('video_tabung_service');
        });
    }
}
