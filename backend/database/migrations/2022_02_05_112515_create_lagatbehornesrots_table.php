<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLagatbehornesrotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lagatbehornesrots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        DB::table('lagatbehornesrots')->insert(
            array(
                'id' => 1,
                'name' => 'छैन'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lagatbehornesrots');
    }
}
