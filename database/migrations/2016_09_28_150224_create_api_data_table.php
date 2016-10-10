<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('api_data', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('timestamp');
            $table->dateTime('date_time');
            $table->time('call_duration');
            $table->string('phone_number', 15);
            $table->string('phone_number_name');
            $table->string('call_resolution', 50);
            $table->string('msg');
            $table->string('caller_id', 15);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode', 15)->nullable();
            $table->string('phone_number_formatted', 15);
            $table->integer('page_count');
            $table->string('group')->nullable();
            $table->string('user')->nullable();
            $table->string('call_direction', 50);
            $table->string('access', 50);
            $table->string('status')->nullable();
            $table->integer('npa');
            $table->integer('nxxx');
            $table->string('call_type');
            $table->string('current_url')->nullable();
            $table->string('widget_name')->nullable();
            $table->integer('source_type');
            $table->string('category')->nullable();
            $table->boolean('type');
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
        Schema::connection('mysql2')->drop('api_data');
    }
}
