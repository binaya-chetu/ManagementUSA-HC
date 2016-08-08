<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_reports', function (Blueprint $table) {
            $table->increments('id', 11);
            $table->integer('patient_id');
            $table->integer('appointments_id');
            $table->string('file', 255);
			$table->string('file_name', 255)->comment('Original name of file uploaded');
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
