<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating_id')->unsigned()->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('title', 100);
            $table->string('comments',250);
            $table->boolean('isCompleted')->nullable();
            $table->integer('assignTo')->nullable();
            $table->integer('assignBy')->nullable();
            $table->boolean('unread2initiator')->default(0)->nullable();
            $table->boolean('unread2handler')->default(0)->nullable();
            $table->dateTime('createdTime')->nullable();


            $table->timestamps();
            //$table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issue_trackings');
    }
}
