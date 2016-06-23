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
            $table->string('libido_rate');
            $table->string('energy_rate');  
            $table->string('strength_rate');  
            $table->string('enjoy_rate');  
            $table->string('happiness_rate');  
            $table->string('erection_rate');  
            $table->string('performance_rate');  
            $table->string('sleep_rate');  
            $table->string('sport_rate');  
            $table->string('lost_height_rate');              
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
