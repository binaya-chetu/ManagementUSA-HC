<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('marketing_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 20);  
            $table->string('name', 180); // name of the marketing agency
            $table->tinyInteger('status');  
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
