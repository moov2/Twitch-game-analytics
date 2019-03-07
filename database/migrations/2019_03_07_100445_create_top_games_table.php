<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_game', function (Blueprint $table) {
            $table->bigIncrements('top_game_id');
            $table->timestamps();

            $table->bigInteger('game_id');
            $table->char('name', 255);
            $table->char('box_art_url', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_game');
    }
}
