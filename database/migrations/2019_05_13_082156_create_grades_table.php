<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('value')->default(2);
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();
        });

         Schema::table('grades', function (Blueprint $table) {
         $table->foreign('student_id')
         ->references('id')->on('students')
         ->onDelete('cascade');  

         $table->foreign('subject_id')
         ->references('id')->on('subjects')
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
        Schema::dropIfExists('grades');
    }
}
