<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid');
            $table->string('name')->nullable();
            $table->string('key')->nullable();
            $table->string('sic_code')->nullable();
            $table->string('tax_code')->nullable();
            $table->string('tax_id')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->float('annual_revenue_cents')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
