<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('middle_name');
            $table->date('birthdate');
            $table->enum('gender', ['m', 'f']);
            $table->string('phone_number', 15)->unique();
            $table->string('telegram_user_id', 15)->unique()->nullable();
            $table->string('address');
            $table->string('photo')->unique()->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
