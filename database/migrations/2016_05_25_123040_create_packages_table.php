<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');  
            $table->integer('category_id');
            $table->integer('product_count');  
            $table->double('product_price');  
            $table->string('category_type', 63);  
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
