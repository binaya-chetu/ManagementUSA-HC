<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function($table)
        {
            $table->dropColumn(['agent_id', 'user_id', 'subtotal_amount', 'discount_amount', 'total_amount', 'package_id', 'package_type']);     
            $table->integer('payment_id')->after('id');
            $table->string('category')->after('payment_id');                        
            $table->decimal('price',10,2)->after('package_type');
            $table->decimal('discount_price',10,2)->after('price');
	});
        Schema::table('orders', function($table)
        {
            $table->string('package_type')->after('category');
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
