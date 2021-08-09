<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsToMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('reply_to_id')->references('id')->on('messages')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->index(['id']);
            $table->index(['id', 'sender_id', 'receiver_id']);
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
            $table->dropForeign('reply_to_id');
            $table->dropIndex(['id']);
            $table->dropIndex(['id', 'sender_id', 'receiver_id']);
            //
        });
    }
}
