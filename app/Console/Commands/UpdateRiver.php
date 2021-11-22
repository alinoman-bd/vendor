<?php

namespace App\Console\Commands;

use App\River;
use Illuminate\Console\Command;

class UpdateRiver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:update';

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
        $rivers = River::all()->pluck('id');
        foreach ($rivers as $river_id) {
            $river = River::find($river_id);
            if ($river) {
                $similer_rivers = River::where('name', 'like', $river->name)->get();
                $current_river = $similer_rivers[0];
                foreach ($similer_rivers as $key => $similer_river) {
                    if ($key == 0) {
                        continue;
                    }
                    foreach ($similer_river->location as $location) {
                        echo '[ Pivot => '. $location->pivot->river_id .' => '. $river->id.' ]' . PHP_EOL;
                        $location->pivot->river_id = $river->id;
                        $location->pivot->save();
                    }
                    foreach ($similer_river->resources as $resource) {
                        echo '[ Resource => '. $resource->river_id .' => '. $river->id.' ]' . PHP_EOL;
                        $resource->river_id = $river->id;
                        $resource->save();
                    }
                    $similer_river->delete();
                }
            }
        }
    }
}
