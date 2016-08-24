<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function($table)
        {
            $table->dropColumn(['payment_type']);                 
	});
        Schema::table('payments', function($table)
        {
            $table->dropColumn(['user_id', 'order_id', 'amount']);     
            $table->integer('patient_id')->after('id');
            $table->integer('agent_id')->after('patient_id');            
            $table->tinyInteger('payment_type')->after('agent_id')->comment('0=> Cash In Hand, 1=> Credit Card');
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
