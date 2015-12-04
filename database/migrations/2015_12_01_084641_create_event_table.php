<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
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
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('slug');
            $table->text('summary');
            $table->text('content');
            $table->timestamp('published_at');
            $table->timestamp('started_at');
            $table->timestamp('ended_at');
            $table->string('location');
            $table->integer('komunitas_id')->unsigned();
            $table->timestamps();

            $table->index('slug');
            $table->index('published_at', 'started_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
