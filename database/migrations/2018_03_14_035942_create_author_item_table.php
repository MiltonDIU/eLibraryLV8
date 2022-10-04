<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_item', function (Blueprint $table) {

            $table->id();

            //$table->primary(['department_id','item_id']);
            $table->foreignId('author_id')->references('id')->on('authors')->onDelete('cascade');

            $table->foreignId('item_id')->references('id')->on('items')->onDelete('cascade');


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
        Schema::dropIfExists('author_item');
    }
}
