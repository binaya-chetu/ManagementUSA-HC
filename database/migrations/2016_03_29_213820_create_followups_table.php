<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followUps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appt_id')->unsigned;
            $table->string('created_by'); //user_who_created
            $table->string('action'); //filled_by_user
            $table->integer('status');// done/not_done
            $table->string('comment');
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
        Schema::drop('followUps');
    }
}
