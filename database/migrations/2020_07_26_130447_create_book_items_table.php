<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->string('number', 10);
            $table->enum('status', ['available', 'repair', 'decommissioned', 'lost'])->default('available');
            $table->text('note')->nullable();
            $table->foreign('book_id')
                ->references('id')->on('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['book_id', 'number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_items');
    }
}
