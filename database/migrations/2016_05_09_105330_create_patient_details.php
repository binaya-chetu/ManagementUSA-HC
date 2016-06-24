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
            $table->integer('disease_id');
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('marital_status', 15);
            $table->string('phone', 15);
            $table->string('mobile', 15);
            $table->string('call_time', 15);
            $table->string('driving_license');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable(); 
            $table->string('city')->nullable();
            $table->integer('state');
            $table->string('zipCode',11);       
            $table->string('height',15);
            $table->string('width',15);
            $table->string('employment_place');
            $table->string('primary_physician');
            $table->string('physician_phone');
            $table->string('image')->nullable();
            $table->string('employer')->nullable();
            $table->string('occupation')->nullable();
            $table->string('payment_bill')->nullable();
            $table->string('hash');
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
