<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWebsite extends Migration
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
            $table->timestamp('since');
            $table->timestamp('until')->nullable();
            $table->text('acl');
            $table->timestamps();

            $table->index(['user_id', 'website_id']);
            $table->index(['website_id', 'user_id']);
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
