<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPublishersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_publishers', function (Blueprint $table) {
            $table->bigInteger('book_id')->unsigned()->unique();
            $table->bigInteger('publisher_id')->unsigned();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('publisher_id')
                ->references('id')->on('publishers')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_publishers');
    }
}
