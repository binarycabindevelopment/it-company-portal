<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uuid')->unique();
            $table->integer('author_user_id');
            $table->text('title')->nullable();
            $table->text('service_board')->nullable();
            $table->string('ticketable_type')->nullable();
            $table->integer('ticketable_id')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->string('sub_type')->nullable();
            $table->string('item')->nullable();
            $table->string('source')->nullable();
            $table->string('priority')->nullable();
            $table->text('summary')->nullable();
            $table->text('details')->nullable();
            $table->text('analysis')->nullable();
            $table->text('resolution')->nullable();
            $table->string('configuration_name')->nullable();
            $table->string('resource_member')->nullable();
            $table->datetime('completed_at')->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
