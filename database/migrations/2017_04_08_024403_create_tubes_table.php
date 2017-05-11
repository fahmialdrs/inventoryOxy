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
            $table->string('barcode');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tubes');
    }
}
