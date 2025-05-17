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
        Schema::create('users_teams', function (Blueprint $table) {
            $table->id('id_user_team');
            $table->unsignedBigInteger("id_user"); //PK de users
            $table->foreign('id_user')->references('id')->on('users');
            $table->unsignedBigInteger("id_team"); //PK de users
            $table->foreign('id_team')->references('id_teams')->on('teams');
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
        Schema::dropIfExists('users_teams');
    }
};
