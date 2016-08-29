<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientVitaminListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_vitamin_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');  
            $table->string('name');
            $table->tinyInteger('dosage')->nullable();
             $table->string('how_often', 31);         
            $table->string('taken_for', 31);
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
