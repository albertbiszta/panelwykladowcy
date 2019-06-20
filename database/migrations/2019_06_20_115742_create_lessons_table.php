<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('subject_id')->unsigned();
         $table->integer('group_id')->unsigned();
         $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
         $table->text('topic')->nullable();
         $table->tinyInteger('performed')->nullable()->default(0);
     });


        Schema::table('lessons', function (Blueprint $table) {
         $table->foreign('subject_id')
         ->references('id')->on('subjects')
         ->onDelete('cascade');  

         $table->foreign('group_id')
         ->references('id')->on('groups')
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
        Schema::dropIfExists('lessons');
    }
}
