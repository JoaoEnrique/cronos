<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_messages', function (Blueprint $table) {
            $table->id('id_files_messages');
            $table->unsignedBigInteger("id_message_team"); //PK de users
            $table->string('file_name', 100)->nullable();
            $table->foreign('id_message_team')->references('id_message_team')->on('messages_team');
            $table->string('type_file', 2);
            $table->string('path_file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_messages');
    }
};
