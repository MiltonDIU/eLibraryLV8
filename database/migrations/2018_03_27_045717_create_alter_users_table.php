<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('sister_concern_id')->nullable()->references('id')->on('sister_concerns')->onDelete('cascade');

            $table->string('username',50)->after('sister_concern_id');
            $table->string('displayName',50)->after('username')->nullable();

            $table->string('securityKey',50)->after('displayName')->nullable();
            $table->string('imagePP',50)->after('securityKey')->nullable();
            $table->string('imageIcon',50)->after('imagePP')->nullable();
            $table->string('referenceId',10)->after('imageIcon')->nullable();
            $table->string('verification_code', 100)->after('referenceId')->nullable();

            $table->string('mobile', 15)->nullable();
            $table->string('deptName', 50)->nullable();
            $table->string('designation', 50)->nullable();
            $table->text('imageBase64')->nullable();
            $table->timestamp('last_login_time')->nullable();
            $table->tinyInteger('isAdmin')->default(0);
            $table->tinyInteger('loginStatus')->default(0);
            $table->tinyInteger('verified')->after('verification_code')->default(0);
            $table->tinyInteger('status')->after('verified')->default(0);

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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['sister_concern_id']);
            $table->dropColumn('sister_concern_id');
        });
    }
}
