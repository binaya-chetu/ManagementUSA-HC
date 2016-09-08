<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('emi', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type'); // type of emi like 3 , 6 or 12 months
			$table->decimal('emi_amount',10,2)->comment('amont to be paid');
			$table->decimal('emi_paid',10,2)->comment('if empty then emi not paid if value present, the equals the amount paid');			
            $table->integer('patient_id')->unsigned;
            $table->integer('agent_id')->unsigned;
            $table->integer('payment_id')->unsigned;
            $table->date('due_date')->comment('due date for the emi');
            $table->date('payment_date')->comment('d');
            $table->timestamps();
            $table->softDeletes();          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('appointments');
    }
}
