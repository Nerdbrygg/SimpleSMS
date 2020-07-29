<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimplemessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simplemessages', function (Blueprint $table) {
            $table->increments('id');

            $table->bigunsignedInteger('user_id')->nullable();
            $table->string('source')->default('SimpleSMS');
            $table->string('destination');
            $table->text('message');

            $table->string('status');

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
        Schema::dropIfExists('simplemessages');
    }
}
