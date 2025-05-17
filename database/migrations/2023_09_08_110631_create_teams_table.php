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
        Schema::create('teams', function (Blueprint $table) {
            $table->id('id_teams');
            $table->unsignedBigInteger("id_user"); //PK de users
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('name');
            $table->string('description');
            $table->string('team_code')->unique();
            $table->string('color');
            $table->string('closed')->nullable();
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
        Schema::dropIfExists('teams');
    }
};
