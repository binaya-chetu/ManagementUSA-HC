<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('call_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 20);  
            $table->tinyInteger('status'); //'missedcall, set or noset'
            $table->string('source');  //'advertizing, digital media etc' 
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
