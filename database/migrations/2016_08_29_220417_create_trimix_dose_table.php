<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrimixDoseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimix_doses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('agent_id');
            $table->string('dose_type');
            $table->integer('quantity');
            $table->string('doctor');
            $table->decimal('amount1', 10, 5);
            $table->string('medicationA1');
            $table->decimal('amount2', 10, 5);
            $table->string('medicationA2');
            $table->decimal('amount3', 10, 5);
            $table->string('medicationB1');
            $table->decimal('amount4', 10, 5);
            $table->string('medicationB2');
            $table->string('antidote', 10)->nullable();
            $table->timestamp('dose_start_date');
            $table->timestamp('dose_end_date')->nullable();
            $table->boolean('permanent_dose_status');
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
        Schema::drop('trimix_doses');
    }
}
