<?php

namespace App\Console\Commands;

use App\Lake;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateLake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lake:update';

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
        $lakes = Lake::all()->pluck('id');
        foreach ($lakes as $lake_id) {
            $lake = Lake::find($lake_id);
            if ($lake) {
                $similer_lakes = Lake::where('name', 'like', $lake->name)->get();
                $current_lake = $similer_lakes[0];
                foreach ($similer_lakes as $key => $similer_lake) {
                    if ($key == 0) {
                        continue;
                    }
                    foreach ($similer_lake->locations as $location) {
                        echo 'location ' .$location->slug . ' => '. $similer_lake->slug . '->'. $lake->slug . PHP_EOL;
                        $location->pivot->lake_id = $lake->id;
                        $location->pivot->save();
                    }
                    foreach ($similer_lake->resources as $resource) {
                        echo 'resource '. $resource->slug . ' => '. $similer_lake->slug . '->'. $lake->slug . PHP_EOL;
                        $resource->lake_id = $lake->id;
                        $resource->save();
                    }
                    $similer_lake->delete();
                }
            }
        }
        $locations = DB::table('lake_location')
            ->select('*')
            ->get();
        foreach ($locations as $location) {
            $relations = DB::table('lake_location')
            ->select('*')
            ->where(['location_id' => $location->location_id, 'lake_id' => $location->lake_id])
            ->get();
            echo 'location '. $location->location_id .' => [' . $relations->count() . ' ]' . PHP_EOL;
            foreach ($relations as $key => $relation) {
                if ($key > 0) {
                    DB::table('lake_location')->delete($relation->id);
                }
            }
        }
    }
}
