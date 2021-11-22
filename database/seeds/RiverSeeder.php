<?php

use App\River;
use App\Location;
use Illuminate\Database\Seeder;

class RiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rivers = collect(json_decode(file_get_contents(__DIR__. "/../Data/Rivers.json")))->toArray();
        $locations = App\Location::all();

        foreach ($locations as  $location) {
            if (count($rivers[$location->name])) {
                foreach($rivers[$location->name] as $river){
                    $l = River::create([
                        'name' => $river
                    ]);
                    $location->rivers()->attach($l);
                }
            } else {
                $locations_data = Location::where('city_id', $location->city_id)
                    ->with('rivers')->get();
                if (count($locations_data)) {
                    foreach ($locations_data as $d) {
                        foreach ($d->rivers as $lk) {
                            $location->rivers()->attach($lk->id);
                        }
                    }
                }
            }
        }
    }
}