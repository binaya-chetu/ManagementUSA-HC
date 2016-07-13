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
            $table->integer('disease_id')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('marital_status', 15);
            $table->string('phone', 15);
            $table->string('mobile', 15);
            $table->string('call_time', 31);
            $table->string('driving_license');
            $table->string('address1')->nullable();
            $table->string('address2')->nullable(); 
            $table->string('city', 31)->nullable();
            $table->integer('state');
            $table->string('zipCode',11);       
            $table->string('height',31);
            $table->string('weight',31);
            $table->string('employment_place', 63);
            $table->string('primary_physician', 63);
            $table->string('physician_phone', 31);
            $table->string('image')->nullable();
            $table->string('employer', 63)->nullable();
            $table->string('occupation', 63)->nullable();
            $table->string('payment_bill')->nullable();
            $table->string('hash');
            $table->boolean('never_treat_status')->default(0);
            $table->boolean('form_status')->default(0);
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
