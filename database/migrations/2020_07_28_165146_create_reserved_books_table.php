<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserved_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('reserved_by');
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onUpdate('cascade');
            $table->foreign('reserved_by')
                ->references('id')->on('users')
                ->onUpdate('cascade');

            $table->timestamps();

            $table->unique(['book_id', 'reserved_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserved_books');
    }
}
