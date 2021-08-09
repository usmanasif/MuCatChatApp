<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserReferenceToMessage extends Migration
{

    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            //
        });
    }
}
