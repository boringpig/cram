<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClockInWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clockIn_work', function (Blueprint $table) {
            $table->integer('clockIn_id')->unsigned();
            $table->integer('work_id')->unsigned();
            $table->integer('hour');

            $table->foreign('clockIn_id')->references('id')->on('clockIns')->onDelete('cascade');
            $table->foreign('work_id')->references('id')->on('works')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clockIn_work');
    }
}
