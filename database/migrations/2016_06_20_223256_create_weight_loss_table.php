<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightLossTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_loss', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');            
            $table->tinyInteger('weight_surgeries')->nullable()->comment('0=>No, 1=> Yes');            
            $table->string('surgeries_kind', 63); 
            $table->tinyInteger('weight_supplement')->nullable()->comment('0=>No, 1=> Yes'); 
            $table->string('supplement_type', 63);  
            $table->tinyInteger('liver_disease')->nullable()->comment('0=>No, 1=> Yes'); 
            $table->tinyInteger('diabetes')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('thyroid_treated')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('hormone_treated')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('seizures')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('kidney_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('eating_disorder')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('frequently_eat')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('eat_more')->nullable()->comment('0=>No, 1=> Yes');            
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
