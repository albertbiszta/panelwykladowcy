<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('subjects', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->tinyInteger('exam')->default(0)->nullable();;
        $table->integer('ects');
        $table->integer('user_id')->unsigned();
    });
       Schema::table('subjects', function (Blueprint $table) {
         $table->foreign('user_id')
         ->references('id')->on('users')
         ->onDelete('cascade');       
     });
   }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
