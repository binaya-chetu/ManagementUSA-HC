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
            $table->integer('appt_id');
            $table->integer('created_by'); //user_who_created
            $table->tinyInteger('action'); //filled_by_user
            $table->tinyInteger('status')->default(0);// done/not_done
            $table->string('comment');
            $table->date('followup_later_date');
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
