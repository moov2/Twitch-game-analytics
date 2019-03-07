<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \GuzzleHttp\Client;
use Config as Config;
use \App\TopGame;

class SaveTopGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:topgames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve and save top game info';

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
            $response = $client->request('GET', Config::get('twitch.API_URL').'/games/top?first=100',
            ['headers' => 
                ['Client-ID' => Config::get('twitch.CLIENT_ID')]
            ]);

            if($response->getStatusCode() == 200) {

                $games = json_decode($response->getBody()->getContents());

                $topGameDataStore = [];

                foreach($games->data as $key => $game) {
                    $topGameDataStore[] = [
                        'game_id' => $game->id,
                        'name' => $game->name,
                        'box_art_url' => $game->box_art_url,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                
                // Delete existing data
                TopGame::truncate();

                // insert new data
                TopGame::insert($topGameDataStore);
            }
        } catch(BadResponseException $e){
                
        }
    }
}
