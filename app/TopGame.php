<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopGame extends Model
{
    protected $fillable = ['game_id', 'name', 'box_art_url'];

    protected $table = 'top_game';
    protected $primaryKey = 'top_game_id';    
}
