<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowed_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookItem_id');
            $table->unsignedBigInteger('borrower_id');
            $table->unsignedBigInteger('librarian_id');
            $table->timestamp('from_date')->useCurrent();
            $table->timestamp('to_date');
            $table->enum('status', ['reading', 'returned', 'lost'])->default('reading');
            $table->timestamp('date_of_return')->nullable();
            $table->unsignedDecimal('fine')->nullable();
            $table->boolean('paid')->nullable();
            $table->text('note')->nullable();
            $table->foreign('bookItem_id')
                ->references('id')->on('book_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('borrower_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('librarian_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrowed_books');
    }
}
