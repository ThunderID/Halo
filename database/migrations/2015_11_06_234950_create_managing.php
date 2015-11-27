<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManaging extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_website', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('website_id')->unsigned();
            $table->enum('role', ['administrator', 'editor', 'writer', 'subscriber']);
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'website_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_website');
    }
}
