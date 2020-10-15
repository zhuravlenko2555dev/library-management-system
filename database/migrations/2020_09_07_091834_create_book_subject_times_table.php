<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookSubjectTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_subject_times', function (Blueprint $table) {
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('subjectTime_id')->unsigned();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('subjectTime_id')
                ->references('id')->on('subject_times')
                ->onUpdate('cascade');

            $table->unique(['book_id', 'subjectTime_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_subject_times');
    }
}
