<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectkistakobiwaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectkistakobiwarans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->date('pratham_miti')->nullable();
            $table->string('pratham_rakam');
            $table->string('pratham_samagriko_pariman');
            $table->string('pratham_kaifiyet');
            $table->date('dorshro_miti')->nullable();
            $table->string('dorshro_rakam');
            $table->string('dorshro_samagriko_pariman');
            $table->string('dorshro_kaifiyet');
            $table->date('teshro_miti')->nullable();
            $table->string('teshro_rakam');
            $table->string('teshro_samagriko_pariman');
            $table->string('teshro_kaifiyet');
            $table->date('jamma_miti')->nullable();
            $table->string('jamma_rakam');
            $table->string('jamma_samagriko_pariman');
            $table->string('jamma_kaifiyet');

            $table->foreign('projectId')->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectkistakobiwarans');
    }
}
