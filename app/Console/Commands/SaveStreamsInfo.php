<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \GuzzleHttp\Client;
use Config as Config;
use \App\Game;
use \App\Stream;

class SaveStreamsInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:streamsinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve and save streams info for specific game id';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', Config::get('twitch.API_URL').'/streams?game_id='.Config::get('twitch.GAME_ID'),
            ['headers' => 
                ['Client-ID' => Config::get('twitch.CLIENT_ID')]
            ]);

            if($response->getStatusCode() == 200) {

                $game = Game::where('twitch_game_id', Config::get('twitch.GAME_ID'))->first();
                // If game exists use it to update streams, otherwise add the new game
                if(!$game) {
                    $game = new Game;
                    $game->twitch_game_id = Config::get('twitch.GAME_ID');
                }

                $streams = json_decode($response->getBody()->getContents());
                $steamDataStore = [];

                foreach($streams->data as $key => $stream) {
                    $steamDataStore[] = new Stream([
                        'user_id' => $stream->user_id,
                        'user_name' => $stream->user_name,
                        'community_ids' => json_encode($stream->community_ids),
                        'title' => $stream->title,
                        'viewer_count' => $stream->viewer_count,
                        'started_at' => date("Y-m-d H:i:s", strtotime($stream->started_at)),
                        'language' => $stream->language,
                        'thumbnail_url' => $stream->thumbnail_url,
                        'tag_ids' => json_encode($stream->tag_ids)
                    ]);
                }
                $game->save();
                $game->stream()->saveMany($steamDataStore);
            }
        } catch(BadResponseException $e){
                
        }

    }
}
