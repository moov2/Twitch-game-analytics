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
        $data['topStreams'] = $game->topStreams();
        $data['longestStreams'] = $game->longestStreams();
        $data['peakStreams'] = $game->peakStreams();
        $data['topGames'] = $topGame->highlighted();

        return view('home')->with($data);
    }
}
