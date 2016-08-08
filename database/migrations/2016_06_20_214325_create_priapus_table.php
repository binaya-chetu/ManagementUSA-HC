<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriapusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priapus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');  
            $table->tinyInteger('abnormal')->nullable()->comment('0=>No, 1=> Yes');           
            $table->string('abnormal_type');  
            $table->string('priapus_goal');  
            $table->tinyInteger('prp_before')->nullable()->comment('0=>No, 1=> Yes');  
            $table->tinyInteger('pump_past')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('implant_surgery')->nullable()->comment('0=>No, 1=> Yes');  
            $table->tinyInteger('pre_activity_score')->nullable();
            $table->tinyInteger('prp_stimulation_score')->nullable();  
            $table->tinyInteger('prp_intercourse_score')->nullable();
            $table->tinyInteger('prp_maintain_score')->nullable();
            $table->tinyInteger('prp_difficult_score')->nullable();  
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
