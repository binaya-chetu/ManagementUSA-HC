<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosmeticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cosmetics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');            
            $table->tinyInteger('facial_surgeries')->nullable()->comment('0=>No, 1=> Yes');            
            $table->string('facial_kind', 63); 
            $table->string('face_wash', 63); 
            $table->string('exposure', 63); 
            $table->string('skin_look', 63); 
            $table->string('look_score', 63); 
            $table->string('happy_score', 63); 
            $table->tinyInteger('crowsfeet')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('facial_expression')->nullable()->comment('0=>No, 1=> Yes'); 
            $table->tinyInteger('sunken')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('bullfrog_looking')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('loose_skin')->nullable()->comment('0=>No, 1=> Yes');   
            $table->tinyInteger('thin_lip')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('face_spot')->nullable()->comment('0=>No, 1=> Yes');   
            $table->tinyInteger('acne')->nullable()->comment('0=>No, 1=> Yes');
            $table->tinyInteger('skin_tag')->nullable()->comment('0=>No, 1=> Yes'); 
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
