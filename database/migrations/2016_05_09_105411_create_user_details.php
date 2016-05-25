<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
           $table->increments('id');
			$table->integer('user_id')->unique();
			$table->date('dob')->nullable();
			$table->enum('gender', ['Male', 'Female'])->default('Male');
			$table->string('phone', 15);			
			$table->string('address1');
			$table->string('address2');
			$table->string('city');
			$table->integer('state');
			$table->string('zipCode', 11);
			$table->string('image');
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
        Schema::drop('user_details');
    }
}
