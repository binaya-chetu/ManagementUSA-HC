<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->integer('status');
            $table->string('email')->unique();
			$table->date('dob');
			$table->enum('gender', ['Male', 'Female'])->default('Male');;
            $table->string('phone');
            $table->string('address1');
            $table->string('address2'); 
            $table->string('city');
            $table->string('state');
            $table->integer('zipCode');
            $table->string('employer');
            $table->string('occupation');
			$table->string('payment_bill');
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
        Schema::drop('patients');
    }
}
