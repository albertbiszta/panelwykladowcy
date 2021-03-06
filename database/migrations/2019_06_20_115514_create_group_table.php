<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('groups', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('contact')->nullable();
        $table->integer('user_id')->unsigned();
    });

      Schema::table('groups', function (Blueprint $table) {
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
        Schema::dropIfExists('group');
    }
}
