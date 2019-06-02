<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_user_id');
            $table->integer('eventable_id');
            $table->string('eventable_type');
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->string('name');
            $table->text('details')->nullable();
            $table->string('repeat')->nullable();
            $table->text('type')->nullable();
            $table->boolean('constraint')->default(false);
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
        Schema::dropIfExists('events');
    }
}
