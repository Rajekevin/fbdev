<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->boolean('disabled')->default(false);

            $table->integer('author')->unsigned();
            $table->foreign('author')->references('id')->on('users');

            $table->integer('contest')->unsigned();
            $table->foreign('contest')->references('id')->on('contests');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
