<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientMedicationListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medication_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->string('name');
            $table->boolean('dosage');
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
