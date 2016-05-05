<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appt')->unsigned;
            $table->integer('user_id')->unsigned;
            $table->integer('description');
            $table->integer('status');//NP or CP
            $table->integer('cash');
            $table->integer('credit_cd');
            $table->integer('credit_cd2');
            $table->integer('credit_cd3');
            $table->integer('check');
            $table->integer('lab_follow_up');
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
        Schema::drop('sales');
    }
}
