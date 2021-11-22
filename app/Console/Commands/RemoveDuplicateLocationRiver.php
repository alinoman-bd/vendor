<?php

namespace App\Console\Commands;

use App\Location;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveDuplicateLocationRiver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'river:remove';

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
        $locations = DB::table('location_river')
            ->select('*')
            ->get();
        foreach ($locations as $location) {
            $relations = DB::table('location_river')
            ->select('*')
            ->where(['location_id' => $location->location_id, 'river_id' => $location->river_id])
            ->get();
            echo 'location '. $location->location_id .' => [' . $relations->count() . ' ]' . PHP_EOL;
            foreach ($relations as $key => $relation) {
                if ($key > 0) {
                    DB::table('location_river')->delete($relation->id);
                }
            }
        }
    }
}