<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config as Config;
use \App\Game;
use \App\Stream;
use \App\TopGame;

class HomeViewController extends Controller
{
    
    public function home($game_id = null) {

        if($game_id) {
            $game = Game::Where('twitch_game_id', $game_id)->first();

            if(!$game) {
                return abort(404);
            }
        } else {
            $game = Game::first();
        }
        $topGame = new TopGame();
        $data['currentGame'] = $topGame->currentGame($game->twitch_game_id);
        $data['topStreams'] = $game ? $game->topStreams() : null;
        $data['longestStreams'] = $game ? $game->longestStreams() : null;
        $data['peakStreams'] = $game ? $game->peakStreams() : null;
        $data['topGames'] = $topGame ? $topGame->highlighted($game->twitch_game_id) : null;

        return view('home')->with($data);
    }
}
