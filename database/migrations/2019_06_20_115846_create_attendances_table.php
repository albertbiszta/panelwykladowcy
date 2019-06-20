<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('lesson_id')->unsigned();
           $table->integer('student_id')->unsigned();
           $table->string('status');
       });


      Schema::table('attendances', function (Blueprint $table) {
        
       $table->foreign('lesson_id')
       ->references('id')->on('lessons')
       ->onDelete('cascade');  

        $table->foreign('student_id')
       ->references('id')->on('students')
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
        Schema::dropIfExists('attendances');
    }
}
