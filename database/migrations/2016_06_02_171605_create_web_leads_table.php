<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('web_leads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstName');  
            $table->string('lastName');
            $table->string('email');  
            $table->string('phone');  
            $table->string('location');  
            $table->timestamp('requested_date');  
            $table->string('call_time');  
            $table->integer('status');  
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
