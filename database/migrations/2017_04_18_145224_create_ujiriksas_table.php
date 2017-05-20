<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUjiriksasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formujiriksas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_registrasi');
            $table->string('jenis_uji');
            $table->string('nama_pengambil')->nullable();            
            $table->string('keterangan');            
            $table->date('perkiraan_selesai');
            $table->string('perkiraan_biaya');
            $table->string('nama_penyerah');
            $table->string('progress');
            $table->timestamps();
            $table->timestamp('progress_at')->nullable();
            $table->timestamp('done_at')->nullable();

            $table->integer('customer_id')->unsigned();

            $table->foreign('customer_id')->references('id')->on('customers')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('itemujiriksas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jumlah_barang');
            $table->string('nama_barang');
            $table->string('keluhan');
            $table->integer('tube_id')->unsigned();

            $table->foreign('tube_id')->references('id')->on('tubes')
                ->onUpdate('cascade')->onDelete('cascade');
        
            $table->integer('formujiriksa_id')->unsigned();

            $table->foreign('formujiriksa_id')->references('id')->on('formujiriksas')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('visualresults', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan_visual')->nullable();
            $table->timestamps();
            $table->integer('itemujiriksa_id')->unsigned();

            $table->foreign('itemujiriksa_id')->references('id')->on('itemujiriksas')
                ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('fotovisuals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_tabung_visual');
            $table->integer('visualresult_id')->unsigned();

            $table->foreign('visualresult_id')->references('id')->on('visualresults')
                ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('hydrostaticresults', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tekanan_kerja');
            $table->string('tekanan_pemadatan');
            $table->string('pabrik_pembuat_tabung');
            $table->string('pabrik_pemakai_tabung');
            $table->string('berat_tercatat');
            $table->string('berat_sekarang');
            $table->string('selisih-');
            $table->string('selisih+');
            $table->string('selisih%');
            $table->string('air_dipadatkan');
            $table->string('pemuaian_tetap_cm3');
            $table->string('pemuaian_tetap_%');
            $table->string('suara_pukulan');
            $table->string('keadaan_karat');
            $table->string('keadaan_luar');
            $table->string('masa_berpori');
            $table->date('tanggal_uji');
            $table->string('keterangan');
            $table->timestamps();
            $table->integer('itemujiriksa_id')->unsigned();

            $table->foreign('itemujiriksa_id')->references('id')->on('itemujiriksas')
                ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('serviceresults', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan_service')->nullable();
            $table->timestamps();
            $table->integer('itemujiriksa_id')->unsigned();

            $table->foreign('itemujiriksa_id')->references('id')->on('itemujiriksas')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('fotoservices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_tabung_service');
            $table->integer('serviceresult_id')->unsigned();

            $table->foreign('serviceresult_id')->references('id')->on('serviceresults')
                ->onUpdate('cascade')->onDelete('cascade');

        });

        Schema::create('fototabungs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto_tabung_masuk');
            $table->string('keterangan_foto')->nullable();
            $table->integer('itemujiriksa_id')->unsigned();

            $table->foreign('itemujiriksa_id')->references('id')->on('itemujiriksas')
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
        Schema::dropIfExists('fototabungs');
        Schema::dropIfExists('fotoservices');
        Schema::dropIfExists('serviceresults');
        Schema::dropIfExists('hydrostaticresults');
        Schema::dropIfExists('fotovisuals');
        Schema::dropIfExists('visualresults');            
        Schema::dropIfExists('itemujiriksa_tube');
        Schema::dropIfExists('itemujiriksas');
        Schema::dropIfExists('formujiriksas');
        
    }
}
