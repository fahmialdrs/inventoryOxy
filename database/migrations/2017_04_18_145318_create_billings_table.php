<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('no_invoice');
            $table->integer('customer_id')->unsigned();
            $table->date('tanggal_invoice');
            $table->string('perihal');
            $table->integer('subtotal');
            $table->integer('ongkir');
            $table->integer('discount');
            $table->integer('total');
            $table->string('terbilang');
            $table->string('catatan')->nullable();
            $table->string('status');
            $table->timestamps();
            

            $table->foreign('customer_id')->references('id')->on('customers')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('itembillings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->string('deskripsi');
            $table->integer('unitprice');
            $table->integer('amount');
            $table->timestamps();
            $table->integer('billing_id')->unsigned();

            $table->foreign('billing_id')->references('id')->on('billings')
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
        Schema::dropIfExists('itembillings');
        Schema::dropIfExists('billings');

    }
}
