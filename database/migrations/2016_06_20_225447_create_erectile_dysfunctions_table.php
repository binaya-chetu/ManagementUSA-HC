<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateErectileDysfunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erectile_dysfunctions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');            
            $table->tinyInteger('sex_status')->nullable()->comment('0=>No, 1=> Yes');   
            $table->string('sex_often');
            $table->string('sex_with');
            $table->tinyInteger('pronography')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('prostate_removal')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('nerve_damage')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('erectile')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('implant')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('penis_pump')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('recreational')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('ejaculate')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('medicine_used')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('sickle')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('dwarfing')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('hiv')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('sex_medicine')->nullable()->comment('0=>No, 1=> Yes');            
            $table->string('medicine_name'); 
            $table->tinyInteger('medicine_work')->nullable()->comment('0=>No, 1=> Yes'); 
            $table->string('last_used');     
            $table->string('still_work'); 
            $table->tinyInteger('side_effect')->nullable()->comment('0=>No, 1=> Yes');
            $table->string('erection_time'); 
            $table->string('erection_kind'); 
            $table->string('erection_strength'); 
            $table->tinyInteger('activity_score')->nullable();
            $table->tinyInteger('stimulation_score')->nullable();
            $table->tinyInteger('intercourse_score')->nullable();
            $table->tinyInteger('maintain_score')->nullable();
            $table->tinyInteger('difficult_score')->nullable();
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
