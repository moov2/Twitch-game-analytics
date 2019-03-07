<?php

namespace App;
use Config as Config;

use Illuminate\Database\Eloquent\Model;

class TopGame extends Model
{
    private $maxTopGames = 10;
    protected $fillable = ['game_id', 'name', 'box_art_url'];

    protected $table = 'top_game';
    protected $primaryKey = 'top_game_id';

    public function highlighted() {

        $games = $this->all();

        $currentGamePosition = 0;
        $currentGame = null;

        // First we get the current position and the current game object
        foreach($games as $key => $game) {
            $currentGamePosition++;
            if($game->game_id == Config::get('twitch.GAME_ID')) {
                $currentGame = $game;
                $games[$key]->isCurrentGame = true;
                break;
            }
        }

        // If we didn't find the game then we return first 10 results
        // Or if the current game is within the first 10 results
        if($currentGame == null || $currentGamePosition <= $this->maxTopGames) {
            return [$games->take($this->maxTopGames)];
        }

        $firstSubset = $games->take($this->maxTopGames-3);
        $secondSubset = $games->where('top_game_id', '>=', $currentGame->top_game_id)->take(2);

        return [$firstSubset, $secondSubset];
    }
}
