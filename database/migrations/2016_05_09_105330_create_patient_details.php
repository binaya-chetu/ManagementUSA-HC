<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
             $table->increments('id');
			$table->integer('user_id')->unique();
			$table->date('dob')->nullable();
			$table->enum('gender', ['Male', 'Female'])->default('Male');;
            $table->string('phone', 15);
            $table->string('address1')->nullable();
            $table->string('address2')->nullable(); 
            $table->string('city')->nullable();
            $table->integer('state');
            $table->string('zipCode',11);
			$table->string('image')->nullable();
            $table->string('employer')->nullable();
            $table->string('occupation')->nullable();
			$table->string('payment_bill')->nullable();
			$table->boolean('never_treat_status')->default(0);
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
        Schema::drop('patient_details');
    }
}
