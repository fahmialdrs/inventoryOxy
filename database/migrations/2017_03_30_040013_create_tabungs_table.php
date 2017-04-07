<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTabungsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabungs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_tabung');
            $table->string('isi_gas');
            $table->string('kode_tabung');
            $table->string('warna_tabung');
            $table->string('kapasitas_isiTabung');
            $table->string('tgl_pembuatan');            
            $table->string('status');            
            $table->integer('customer_id')->unsigned();
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
        Schema::dropIfExists('tabungs');
    }
}
