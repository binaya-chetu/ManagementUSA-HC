<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdamsQuestionairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adams_questionaires', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');  
            $table->string('libido_rate', 31);
            $table->string('energy_rate', 31);  
            $table->string('strength_rate', 31);  
            $table->string('enjoy_rate', 31);  
            $table->string('happiness_rate', 31);  
            $table->string('erection_rate', 31);  
            $table->string('performance_rate', 31);  
            $table->string('sleep_rate', 31);  
            $table->string('sport_rate', 31);  
            $table->string('lost_height_rate', 31);              
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
