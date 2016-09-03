<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChoiceUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choice_user', function (Blueprint $table) {
            $table->unsignedInteger('choice_id');
            $table->unsignedInteger('user_id');
            $table->string('choice_user',5)->nullable();
            $table->foreign('choice_id')->references('id')->on('choices')->onDelete('CASCADE');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('choice_user');
    }
}
