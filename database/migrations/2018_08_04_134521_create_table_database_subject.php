<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDatabaseSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_subject', function (Blueprint $table) {
            $table->id();
//            $table->integer('a2z_subject_id')->unsigned();
//            $table->foreign('a2z_subject_id')->references('id')->on('a2z_databases')->onDelete('cascade');
//
//            $table->integer('a2z_database_id')->unsigned();
//            $table->foreign('a2z_database_id')->references('id')->on('a2z_subjects')->onDelete('cascade');

            $table->foreignId('a2z_subject_id')->references('id')->on('a2z_subjects')->onDelete('cascade');
            $table->foreignId('a2z_database_id')->references('id')->on('a2z_subjects')->onDelete('cascade');

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
        Schema::dropIfExists('database_subject');
    }
}
