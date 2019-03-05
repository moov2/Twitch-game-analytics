<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = ['user_id', 'user_name', 'community_ids', 'title', 'viewer_count', 'started_at', 'language', 'thumbnail_url', 'tag_ids'];
    protected $table = 'stream';
    protected $primaryKey = 'stream_id';
}
