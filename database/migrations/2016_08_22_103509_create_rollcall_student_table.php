<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRollCallStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rollCall_student', function (Blueprint $table) {
            $table->integer('rollCall_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->tinyInteger('status');
            $table->string('description');

            $table->foreign('rollCall_id')->references('id')->on('rollCalls')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rollCall_student');
    }
}
