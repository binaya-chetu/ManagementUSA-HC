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
            $table->string('facial_kind'); 
            $table->string('face_wash'); 
            $table->string('exposure'); 
            $table->string('skin_look'); 
            $table->string('look_score'); 
            $table->string('happy_score'); 
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
