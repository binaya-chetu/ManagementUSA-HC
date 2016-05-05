<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName', 255);
            $table->string('lastName', 255);
            $table->integer('status'); 
			$table->string('email', 255);
			$table->date('dob');
			$table->enum('gender', ['Male', 'Female'])->default('Male');
			$table->string('phone', 15);			
			$table->text('address1');
			$table->text('address2');
			$table->string('city', 255);
			$table->string('state', 255);
			$table->string('zipCode', 11);
			$table->string('employer', 255);
			$table->string('occupation', 255);
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
        //
    }
}
