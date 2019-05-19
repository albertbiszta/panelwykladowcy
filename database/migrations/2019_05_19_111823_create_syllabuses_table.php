<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyllabusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('syllabuses', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('subject_id')->unsigned();
        $table->string('language')->default('polski')->nullable();
        $table->text('description')->nullable();
        $table->text('literature')->nullable();

        $table->timestamps();
    });

      Schema::table('syllabuses', function (Blueprint $table) {
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
        Schema::dropIfExists('syllabuses');
    }
}
