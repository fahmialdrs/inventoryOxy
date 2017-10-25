<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSingkatanToJenisAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenisalats', function (Blueprint $table) {
            $table->string('slugjenis')->nullable()->after('nama_alat');
        });

        Schema::table('merks', function (Blueprint $table) {
            $table->string('slugmerk')->nullable()->after('nama_merk');
        });

        Schema::table('tipes', function (Blueprint $table) {
            $table->string('slugtipe')->nullable()->after('nama_tipe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipes', function (Blueprint $table) {
            $table->dropColumn('slugtipe');
        });

        Schema::table('merks', function (Blueprint $table) {
            $table->dropColumn('slugmerk');
        });

        Schema::table('jenisalats', function (Blueprint $table) {
            $table->dropColumn('slugjenis');
        });
    }
}
