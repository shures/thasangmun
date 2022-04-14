<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('upabhokta_samitiko_naam');
            $table->string('upabokta_samitiko_thegana');
            $table->string('aayojanako_naam');
            $table->string('aayojanako_sthal');
            $table->string('aayojanako_udeshya');
            $table->date('aayojana_suru_miti');
            $table->bigInteger('lagat_anuman');
            $table->bigInteger('lagat_behorne_karyalay');
            $table->bigInteger('lagat_behorne_upobhokta_samiti');
            $table->integer('lagatBehorneSrotId')->unsigned();
            $table->bigInteger('lagat_behorne_anne')->nullable();

            $table->string('aayojana_labhanbit_gharpariwar_sangkhya');
            $table->string('aayojana_labhanbit_janasankhya');
            $table->string('aayojana_labhanbit_sangathit_sangkhya');
            $table->string('aayojana_labhanbit_anne');
            $table->date('gathan_vayeko_miti');

            $table->string('upobhokta_samiti_gathan_garda_upasthit_labhanbit_sangkhya');
            $table->string('anubhav_barsa');

            $table->string('yojana_marmat_jimma_line_samiti');
            $table->string('marmat_sambhabit_srot');
            $table->string('janasramdan');
            $table->string('sewa_sulka');
            $table->string('dastur_chandabata');
            $table->string('anne_kehi_vaye');
            $table->date('aayojana_ante_miti');
            $table->integer('wardId')->unsigned();
            $table->integer('ppaId')->unsigned();
            $table->string('adaxyako_number');
            $table->string('kaifiyet');

            $table->foreign('lagatBehorneSrotId')->references('id')->on('lagatbehornesrots');
            $table->foreign('ppaId')->references('id')->on('ppas');
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
        Schema::dropIfExists('projects');
    }
}
