<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'game_id';
    
    public $timestamps = false;

    public function stream() {
        return $this->hasMany('App\Stream', 'game_id');
    }
}
