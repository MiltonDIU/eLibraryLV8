<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateA2zHitCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a2z_hit_counters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('a2z_database_id')->references('id')->on('a2z_databases')->onDelete('cascade');
            $table->dateTime('currentDate');
            $table->integer('hitCount')->default(0);
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
        Schema::dropIfExists('a2z_hit_counters');
    }
}
