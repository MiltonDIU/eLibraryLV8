<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('authorName',150);
            $table->string('slug', 160);
            $table->string('email',50)->unique()->nullable();
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
        //Schema::dropIfExists('authors');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('authors');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
