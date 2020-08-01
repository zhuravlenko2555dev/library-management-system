<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('olid', 15)->unique()->nullable();
            $table->string('isbn', 15)->unique()->nullable();
            $table->string('name')->index();
            $table->string('publish_date')->nullable();
            $table->unsignedSmallInteger('number_of_pages');
            $table->text('description')->nullable();
            $table->string('image_small')->unique()->nullable();
            $table->string('image_medium')->unique()->nullable();
            $table->string('image_large')->unique()->nullable();

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
        Schema::dropIfExists('books');
    }
}
