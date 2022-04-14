<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectpadadhikarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectpadadhikaris', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projectId')->unsigned();
            $table->integer('padadhikariPadaId')->unsigned();
            $table->string('name');
            $table->string('thegana');
            $table->string('na_na');
            $table->string('jilla');

            $table->foreign('projectId')->references('id')->on('projects');
            $table->foreign('padadhikariPadaId')->references('id')->on('padadhikariPadas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectpadadhikaris');
    }
}
