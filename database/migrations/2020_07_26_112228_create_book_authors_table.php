<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_authors', function (Blueprint $table) {
            $table->bigInteger('book_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('author_id')
                ->references('id')->on('authors')
                ->onUpdate('cascade');

            $table->unique(['book_id', 'author_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_authors');
    }
}
