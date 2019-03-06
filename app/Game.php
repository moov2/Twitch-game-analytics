<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon as Carbon;

class Game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'game_id';
    
    public $timestamps = false;

    public function stream() {
        return $this->hasMany('App\Stream', 'game_id');
    }

    public function topStreams() {
        return $this->stream()
                    ->selectRaw('concat(user_name) as user_name, sum(viewer_count) as sum')
                    ->whereDate('created_at', '>=', Carbon::today()->subWeek())
                    ->groupBy('user_name')
                    ->orderBy('sum', 'desc')
                    ->limit(10)
                    ->get();
    }

    public function longestStreams() {
        return $this->stream()
                    ->selectRaw('concat(user_name) as user_name, concat(started_at) as started_at, max(created_at) as created_at, max(TIMESTAMPDIFF(SECOND, started_at,created_at)) as date_diff')
                    ->groupBy('user_name', 'started_at')
                    ->orderBy('date_diff', 'desc')
                    ->limit(10)
                    ->get();
    }
}
