<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('itemCategory', 50);
            $table->string('image', 50)->nullable();
            $table->string('itemCategoryShort', 50)->nullable();
            $table->string('shortDescription', 500)->nullable();
            $table->boolean('accessibilityWithoutAuthentication')->nullable();
            $table->string('externalUrl', 250)->nullable();
            $table->integer('serial')->nullable();
            $table->boolean('isVisible')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
