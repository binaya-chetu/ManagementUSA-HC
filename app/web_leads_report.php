<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateItemsTable extends Migration
{
	use SoftDeletes;
	
   public function up()
   {
       Schema::create('web_leads', function (Blueprint $table) {
           $table->increments('id');
           $table->string('title');
           $table->text('description');
           $table->timestamps();
       });
   }
   public function down()
   {
       Schema::drop("items");
   }
}