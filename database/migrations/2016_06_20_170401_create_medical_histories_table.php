<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalHistoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->tinyInteger('cardiovascular')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('hypertension')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('enocrine_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('prostate')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('lipid')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('cancer_form')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('smoke_status')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('smoke_often');
            $table->string('smoke_quantity');
            $table->tinyInteger('drink_status')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('drink_often');
            $table->string('drink_quantity'); 
            $table->string('activity_level');
            $table->tinyInteger('exercise_status')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('exercise_often');
            $table->tinyInteger('deficiency_status')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('chemical_dependency')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('blood_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('orthopedic_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('known_deficiency')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('carpal_syndrome')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('immune_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('heart_disease')->nullable()->comment('0=>No, 1=> Yes');            
            $table->tinyInteger('lung_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('cancer_status')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('surgeries')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('renal')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('upper')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('allergies')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('genital')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('retention')->nullable()->comment('0=>No, 1=> Yes');            
            $table->tinyInteger('endocrine')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('hyperlipidema')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('healing')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('neurological')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('emotional')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('hypertention_hbp')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('other_illness')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('arthritis')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('recreational_drug')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('blood_test');
            $table->tinyInteger('health_isurance')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('kind_of_hi');  
            $table->tinyInteger('medication')->nullable()->comment('0=>No, 1=> Yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
