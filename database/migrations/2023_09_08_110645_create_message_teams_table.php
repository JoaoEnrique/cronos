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
        Schema::create('messages_team', function (Blueprint $table) {
            $table->id('id_message_team');
            $table->unsignedBigInteger("id_user"); //PK de users
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger("id_team"); //PK de users
            $table->foreign('id_team')->references('id_teams')->on('teams');
            $table->string('text')->nullable();
            $table->string('file')->nullable();
            $table->string('type_file')->nullable();
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
        Schema::dropIfExists('message_team');
    }
};
