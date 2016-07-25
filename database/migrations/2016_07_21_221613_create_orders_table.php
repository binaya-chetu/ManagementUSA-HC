<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');  
			$table->integer('agent_id');
			$table->integer('package_id');
			$table->integer('package_type');	
			$table->decimal('subtotal_amount',10,2);
			$table->decimal('discount_amount',10,2);
			$table->decimal('total_amount', 10,2);
            $table->boolean('status');
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
        Schema::drop('orders');
    }
}
