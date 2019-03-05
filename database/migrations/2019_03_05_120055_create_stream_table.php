<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream', function (Blueprint $table) {
            $table->bigIncrements('stream_id');
            
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('game_id')->on('game')->onDelete('cascade');
            
            $table->timestamps();
            
            // Columns matching twitch API object
            $table->integer('user_id');
            $table->char('user_name', 255);
            $table->text('community_ids');
            $table->text('title');
            $table->integer('viewer_count');
            $table->dateTime('started_at');
            $table->char('language',10);
            $table->char('thumbnail_url', 255);
            $table->text('tag_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream');
    }
}
