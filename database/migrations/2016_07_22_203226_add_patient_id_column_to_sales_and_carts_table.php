<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPatientIdColumnToSalesAndCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('sales', function($table)
		{
			$table->integer('patient_id');
		});
		Schema::table('carts', function($table)
		{
			$table->integer('patient_id');
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
