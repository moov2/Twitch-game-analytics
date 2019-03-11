<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Stream;

class DeleteStreamsInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:streamsinfo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete streams older than 7 days to prevent growing data overtime';

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
        $stream = new Stream();
        $stream->deleteOldData(7);
    }
}
