<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrimixDoseFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trimix_dose_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trimix_dose_id');
            $table->integer('agent_id');
            $table->timestamp('time');
            $table->integer('percentage');
            $table->string('pain');
            $table->string('antidote');
            $table->string('notes');
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
        Schema::drop('trimix_dose_feedback');
    }
}
