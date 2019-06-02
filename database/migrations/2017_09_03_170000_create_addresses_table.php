<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('addressable_type',50);
            $table->integer('addressable_id');
            $table->string('type',50)->nullable();
            $table->string('address_1',150)->nullable();
            $table->string('address_2',150)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',5)->nullable();
            $table->string('zipcode',15)->nullable();
            $table->string('county',50)->nullable();
            $table->string('country',255)->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->integer('weight')->default(0);
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
        Schema::dropIfExists('addresses');
    }
}
