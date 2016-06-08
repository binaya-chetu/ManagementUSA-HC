<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelemarketingCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up() {
        Schema::create('telemarketing_calls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');  
            $table->string('last_name');
            $table->string('email');  
            $table->string('phone');  
            $table->timestamp('requested_date');
            $table->tinyInteger('status')->default(0)->comment('0=>Pending, 1=>Set, 2=>No Set');            
            $table->text('comment');
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