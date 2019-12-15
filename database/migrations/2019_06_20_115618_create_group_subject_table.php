<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('group_subject', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('subject_id')->unsigned();
         
        });

        Schema::table('group_subject', function (Blueprint $table) {
         $table->foreign('group_id')
         ->references('id')->on('groups')
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
        Schema::dropIfExists('group_subject');
    }
}
