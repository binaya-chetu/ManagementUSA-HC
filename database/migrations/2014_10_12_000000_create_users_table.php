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
            $table->string('first_name', 31);
            $table->string('middle_name', 31)->nullable();
            $table->string('last_name', 31);
            $table->string('email', 63)->nullable();
            $table->string('password', 63);
            $table->integer('role');
            $table->rememberToken();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
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
