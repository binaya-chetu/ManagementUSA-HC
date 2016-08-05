<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('cash_in', 10, 2);
            $table->decimal('cash_out', 10, 2);
            $table->string('details');
            $table->date('date');
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
        Schema::drop('cashlogs');
    }
}
