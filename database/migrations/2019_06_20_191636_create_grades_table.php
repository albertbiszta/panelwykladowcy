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
            $table->float('value')->default(2.0);
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
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
