<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config as Config;
use \App\Game;
use \App\Stream;

class HomeViewController extends Controller
{
    
    public function home() {

        $game = Game::Where('twitch_game_id', Config::get('twitch.GAME_ID'))->first();
        $data['topStreams'] = $game->topStreams();
        $data['longestStreams'] = $game->longestStreams();

        return view('home')->with($data);
    }
}
