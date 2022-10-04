<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publisher_id')->references('id')->on('publishers')->onDelete('cascade');

            $table->foreignId('category_id')->references('id')->on('categories')->onDelete('cascade');


            $table->string('project_supervisor', 100)->nullable();

            $table->foreignId('item_standard_number_id')->nullable()->references('id')->on('item_standard_numbers')->onDelete('set null');



            $table->string('title', 500);
            $table->string('slug', 550);
            $table->string('edition',20)->nullable();
            $table->string('itemStandardNumberValue',50)->nullable();
            $table->string('itemStandardNumberValue2',15)->nullable();

            $table->string('issue',50)->nullable();
            $table->string('keywords',250)->nullable();
            $table->string('summary',1000)->nullable();
            $table->string('imageUrl',250)->nullable();
            $table->string('uploadImageUrl', 250)->nullable();

            $table->string('pdfUrl',250)->nullable();
            $table->boolean('isPublished')->default(0)->nullable();
            $table->string('publicationYear', 4)->nullable();
            $table->string('placeOfPublication',100)->nullable();

            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');

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
        //Schema::dropIfExists('items');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('items');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
