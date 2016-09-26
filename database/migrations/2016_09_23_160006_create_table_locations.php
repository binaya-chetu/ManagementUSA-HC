<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('locations', function (Blueprint $table) {
			$table->increments('id');
            $table->string('name');
            $table->string('city');
			$table->string('state');
			$table->integer('patient_id');
			$table->integer('appt_request_id');
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
        //
    }
}
