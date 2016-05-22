<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('sdu_id')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type', 20);
            $table->string('avatar');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('section', 10)->nullable();      // for student
            $table->string('address')->nullable();          // for student
            $table->string('tel', 20)->nullable();          // for student
            $table->string('tel_parent', 20)->nullable();   // for student
            $table->date('birth_date')->nullable();         // for student
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
        Schema::drop('users');
    }
}
