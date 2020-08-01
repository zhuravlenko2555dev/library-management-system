<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookItemShelvesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_item_shelves', function (Blueprint $table) {
            $table->bigInteger('bookItem_id')->unsigned()->unique();
            $table->bigInteger('shelf_id')->unsigned();
            $table->foreign('bookItem_id')
                ->references('id')->on('book_items')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('shelf_id')
                ->references('id')->on('shelves')
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
        Schema::dropIfExists('book_item_shelves');
    }
}
