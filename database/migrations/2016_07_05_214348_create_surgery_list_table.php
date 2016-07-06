<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurgeryListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgery_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');  
            $table->string('type_of_surgery', 150);
            $table->date('date');            
            $table->string('reason', 150);
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
