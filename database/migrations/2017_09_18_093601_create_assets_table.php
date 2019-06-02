<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->integer('author_user_id');
            $table->string('type')->nullable();
            $table->string('category')->nullable();
            $table->string('name')->nullable();
            $table->string('tag_key')->nullable();
            $table->string('sales_vendor_name')->nullable();
            $table->integer('support_vendor_id')->unsigned()->nullable();
            $table->foreign('support_vendor_id')->references('id')->on('support_vendors');
            $table->string('manufacturer')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('model_number')->nullable();
            $table->string('client_tag')->nullable();
            $table->dateTime('purchase_at')->nullable();
            $table->dateTime('installed_at')->nullable();
            $table->string('installed_by')->nullable();
            $table->dateTime('warranty_start_at')->nullable();
            $table->dateTime('warranty_end_at')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->string('configuration_status')->nullable();
            $table->string('configuration_type')->nullable();
            $table->string('configuration_name')->nullable();
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
        Schema::dropIfExists('assets');
    }
}
