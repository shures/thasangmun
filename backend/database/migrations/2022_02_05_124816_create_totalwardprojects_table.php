<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalwardprojectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('totalwardprojects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wardId')->unsigned();
            $table->integer('total')->unsigned();
            $table->string('aaBa');
            $table->foreign('wardId')->references('id')->on('wards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('totalwardprojects');
    }
}
