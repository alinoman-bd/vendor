<?php

namespace App\Console\Commands;

use App\Resource;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateResource extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resource:update';

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
        $resources = Resource::all();
        foreach ($resources as $resource) {
            $Lake_relations = DB::table('lake_location')
            ->select('*')
            ->where(['location_id' => $resource->location_id, 'lake_id' => $resource->lake_id])
            ->get();
            if (!$Lake_relations->count()) {
                echo "Data does not found for => [Loaction : "
                . $resource->location_id . ' Lake : ' . $resource->lake_id . PHP_EOL;
                DB::table('lake_location')->insert(['location_id' => $resource->location_id, 'lake_id' => $resource->lake_id]);
                echo "Data Created ( lake_location )=> [Loaction : "
                . $resource->location_id . ' Lake : ' . $resource->lake_id . PHP_EOL;
            }
        }
        foreach ($resources as $resource) {
            $Lake_relations = DB::table('location_river')
            ->select('*')
            ->where(['location_id' => $resource->location_id, 'river_id' => $resource->river_id])
            ->get();
            if (!$Lake_relations->count()) {
                echo "Data does not found for => [Loaction : "
                . $resource->location_id . ' River : ' . $resource->river_id . PHP_EOL;
                DB::table('location_river')->insert(['location_id' => $resource->location_id, 'river_id' => $resource->river_id]);
                echo "Data Created ( location_river ) => [Loaction : "
                . $resource->location_id . ' River : ' . $resource->river_id . PHP_EOL;
            }
        }
    }
}
