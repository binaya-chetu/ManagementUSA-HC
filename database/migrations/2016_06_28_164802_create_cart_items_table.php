<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id'); 
            $table->integer('product_id');
            $table->string('product_sku');   
            $table->decimal('product_price',2);
            $table->integer('quantity');  
            $table->decimal('discount_price',2);
            $table->decimal('total_price',2);   
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
