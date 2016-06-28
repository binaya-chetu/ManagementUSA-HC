<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');  
            $table->integer('category_id')->nullable();   
            $table->decimal('package_price',2);   
			$table->decimal('discount_price',2);
            $table->decimal('total_amount',2);  
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
