<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unique();
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->string('phone', 15);			
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city', 31)->nullable();
            $table->integer('state');
            $table->string('zipCode', 11);
            $table->string('image', 63)->nullable();
            $table->string('employer', 63)->nullable();
            $table->string('specialization', 63)->nullable();
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
        Schema::drop('doctor_details');
    }
}
