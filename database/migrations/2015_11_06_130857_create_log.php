<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logged_type');
            $table->integer('logged_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('description');
            $table->text('old_data');
            $table->text('new_data');
            $table->timestamps();

            $table->index(['logged_type', 'logged_id']);
            $table->index(['user_id', 'created_at']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('logs');
    }
}
