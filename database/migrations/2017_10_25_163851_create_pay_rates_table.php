<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payable_id')->nullable();
            $table->string('payable_type')->nullable();
            $table->integer('hourly_amount_cents')->nullable();
            $table->integer('rate_charge_amount_cents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_rates');
    }
}
