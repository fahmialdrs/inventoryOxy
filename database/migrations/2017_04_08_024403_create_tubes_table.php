<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tubes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_tabung');
            $table->integer('customer_id')->unsigned();
            $table->string('gas_diisikan');
            $table->string('kode_tabung');
            $table->string('warna_tabung');
            $table->integer('isi_tabung');
            $table->date('tanggal_pembuatan');
            $table->timestamp('terakhir_hydrostatic')->nullable();
            $table->timestamp('terakhir_visualstatic')->nullable();
            $table->timestamp('terakhir_service')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('jenisalats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_alat')->unique();            
            $table->boolean('reminder');
            $table->string('keterangan')->nullable();
        });

        Schema::create('merks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_merk')->unique();
            $table->string('keterangan')->nullable();
        });

        Schema::create('tipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_tipe')->unique();
            $table->string('keterangan')->nullable();
        });

        Schema::create('alats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_alat');
            $table->integer('customer_id')->unsigned();
            $table->integer('jenisalat_id')->unsigned();
            $table->integer('merk_id')->unsigned();
            $table->integer('tipe_id')->unsigned();
            $table->string('ukuran');
            $table->string('warna');
            $table->string('catatan')->nullable();
            $table->timestamp('terakhir_service')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jenisalat_id')->references('id')->on('jenisalats')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('merk_id')->references('id')->on('merks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipe_id')->references('id')->on('tipes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alats');
        Schema::dropIfExists('tipes');
        Schema::dropIfExists('merks');
        Schema::dropIfExists('jenisalats');
        Schema::dropIfExists('tubes');
    }
}
