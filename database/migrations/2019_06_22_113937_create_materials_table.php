<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
              $table->integer('subject_id')->unsigned();
            $table->text('description')->nullable();
            $table->string('file_name');
        
        });

          Schema::table('materials', function (Blueprint $table) {
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
        Schema::dropIfExists('materials');
    }
}
