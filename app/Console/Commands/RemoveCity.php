<?php

namespace App\Console\Commands;

use App\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RemoveCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'city:remove';

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
        $city = City::with('locations.lakes', 'locations.rivers')->first();
        foreach ($city->locations as $location) {
            foreach ($location->rivers as $river) {
                echo 'Deleting => River '. $river->id . PHP_EOL;
                DB::table('location_river')->where('river_id', $river->id)->delete();
            }
            foreach ($location->lakes as $lake) {
                echo 'Deleting => Lake'. $lake->id . PHP_EOL;
                DB::table('lake_location')->where('lake_id', $lake->id)->delete();
            }
            echo 'Deleting => Location ' . $location->id . PHP_EOL;
            $location->delete();
        }
        echo 'Deleting => City ' . $city->id . PHP_EOL;
        $city->delete();
    }
}