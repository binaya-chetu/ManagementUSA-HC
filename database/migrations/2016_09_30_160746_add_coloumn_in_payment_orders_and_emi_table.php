<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumnInPaymentOrdersAndEmiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
           $table->string('order_unique_id', 31)->commnet('Randomly generated value for complete order')->after('id');
        });
        Schema::table('orders', function (Blueprint $table) {
           $table->string('order_unique_id', 31)->commnet('Randomly generated value for complete Order')->after('id');
        });
        Schema::table('emi', function (Blueprint $table) {
           $table->string('order_unique_id', 31)->commnet('Randomly generated value for complete Order')->after('payment_id');
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
