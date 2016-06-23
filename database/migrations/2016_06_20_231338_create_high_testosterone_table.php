<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHighTestosteroneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('high_testosterone', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');            
            $table->tinyInteger('harmone_therapy')->nullable()->comment('1=> Yes');            
            $table->string('harmone_therapy_type');             
            $table->tinyInteger('usa_military')->nullable()->comment('1=> Yes'); 
            $table->tinyInteger('lack_increment')->nullable()->comment('1=> Yes'); 
            $table->tinyInteger('increase_fat')->nullable()->comment('1=> Yes'); 
            $table->tinyInteger('depression')->nullable()->comment('1=> Yes');                  
            $table->tinyInteger('mood_increment')->nullable()->comment('1=> Yes');
            $table->tinyInteger('sleep_difficulty')->nullable()->comment('1=> Yes');
            $table->tinyInteger('wrinkle_increment')->nullable()->comment('1=> Yes');
            $table->tinyInteger('sagging_increment')->nullable()->comment('1=> Yes');
            $table->tinyInteger('hot_flash')->nullable()->comment('1=> Yes');            
            $table->tinyInteger('loss_activity')->nullable()->comment('1=> Yes');
            $table->tinyInteger('stess_increment')->nullable()->comment('1=> Yes');
            $table->tinyInteger('loss_interest')->nullable()->comment('1=> Yes');
            $table->tinyInteger('loose_skin')->nullable()->comment('1=> Yes');                 
            $table->tinyInteger('exercise_ability')->nullable()->comment('1=> Yes');
            $table->tinyInteger('memory_decrement')->nullable()->comment('1=> Yes');
            $table->tinyInteger('loss_muscle')->nullable()->comment('1=> Yes');
            $table->tinyInteger('endurance')->nullable()->comment('1=> Yes');            
            $table->tinyInteger('muscle_decrement')->nullable()->comment('1=> Yes');
            $table->tinyInteger('loss_hair')->nullable()->comment('1=> Yes');   
            $table->tinyInteger('sense_decrement')->nullable()->comment('1=> Yes');
            $table->tinyInteger('testicle_decrement')->nullable()->comment('1=> Yes');            
            $table->tinyInteger('shrinkage')->nullable()->comment('1=> Yes');
            $table->tinyInteger('osteoporosis')->nullable()->comment('1=> Yes');
            $table->tinyInteger('intolerance')->nullable()->comment('1=> Yes');
            $table->tinyInteger('unexplained_weight')->nullable()->comment('1=> Yes');
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
