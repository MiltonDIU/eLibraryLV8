<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateA2zDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a2z_databases', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');


            $table->foreignId('a2z_type_id')->references('id')->on('a2z_types')->onDelete('cascade');
            $table->foreignId('a2z_vendor_id')->references('id')->on('a2z_vendors')->onDelete('cascade');

            $table->string('a2zTitle',100);
            $table->string('a2zDescription',1000)->nullable();
            $table->boolean('trial')->nullable();
            $table->boolean('lock')->nullable();
            $table->string('redirectLink',500)->nullable();
            $table->boolean('isVisible')->default(1)->nullable();
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
        Schema::dropIfExists('a2z_databases');
    }
}
