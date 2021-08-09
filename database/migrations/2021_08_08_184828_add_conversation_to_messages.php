<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConversationToMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->bigInteger('conversation_id')->unsigned();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['sender_id']);
            $table->dropForeign(['receiver_id']);
            $table->dropIndex(['id', 'sender_id', 'receiver_id']);

        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('sender_id');
            $table->dropColumn('receiver_id');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('conversation_id')
                ->references('id')->on('conversations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('conversation_id');
            $table->dropColumn('conversation_id');
        });
    }
}
