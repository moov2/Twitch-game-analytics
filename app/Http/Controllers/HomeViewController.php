<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config as Config;
use \App\Game;
use \App\Stream;
use \App\TopGame;

class HomeViewController extends Controller
{
    
    public function home() {

        $game = Game::Where('twitch_game_id', Config::get('twitch.GAME_ID'))->first();
        $topGame = new TopGame();
        $data['currentGame'] = $topGame->currentGame();
        $data['topStreams'] = $game ? $game->topStreams() : null;
        $data['longestStreams'] = $game ? $game->longestStreams() : null;
        $data['peakStreams'] = $game ? $game->peakStreams() : null;
        $data['topGames'] = $topGame ? $topGame->highlighted() : null;

        return view('home')->with($data);
    }
}
