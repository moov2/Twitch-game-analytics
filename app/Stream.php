<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon as Carbon;

class Stream extends Model
{
    protected $fillable = ['user_id', 'user_name', 'community_ids', 'title', 'viewer_count', 'started_at', 'language', 'thumbnail_url', 'tag_ids'];
    protected $table = 'stream';
    protected $primaryKey = 'stream_id';


    public function deleteOldData($days = 7) {
        return $this->whereDate('created_at', '<', Carbon::today()->subDays($days))
                    ->delete();
    }
}
