<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSisterConcernsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sister_concerns', function (Blueprint $table) {
            $table->id();
            $table->string('concernName',100);
            $table->string('emailDomain',50);
            $table->string('name', 50)->nullable();
            $table->string('designation', 50)->nullable();
            $table->string('concernAuthorityEmail',50)->unique()->nullable();
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
        Schema::dropIfExists('sister_concerns');
    }
}
