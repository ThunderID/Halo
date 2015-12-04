<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
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
            $table->string('addressable_type');
            $table->integer('addressable_id')->unsigned();
            $table->string('road');
            $table->string('city');
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();

            $table->index(['addressable_type', 'addressable_id']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addresses');
    }
}
