<?php

namespace App\Console\Commands;

use App\Sea;
use Illuminate\Console\Command;

class UpdateSea extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sea:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $seas = Sea::all()->pluck('slug');
        foreach ($seas as $slug) {
            $sea = Sea::where('slug', 'LIKE',  $slug . '-');
            foreach ($sea as $se) {
                echo 'sea ' .  $se->slug . PHP_EOL;
                $se->delete();
            }
        }
    }
}
