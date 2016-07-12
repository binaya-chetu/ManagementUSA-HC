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
            $table->string('first_name', 31);  
            $table->string('last_name', 31);
            $table->string('email');  
            $table->string('phone', 15);  
            $table->string('location');  
            $table->timestamp('requested_date');  
            $table->string('call_time', 31);  
            $table->tinyInteger('status')->comment('0=> Pending, 1=>Completed');  
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
