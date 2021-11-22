<?php

use App\Lake;
use App\Location;
use Illuminate\Database\Seeder;

class LakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lakes = collect(json_decode(file_get_contents(__DIR__. "/../Data/Lakes.json")))->toArray();
        $locations = App\Location::all();
        foreach ($locations as  $location) {
            if (count($lakes[$location->name])) {
                foreach($lakes[$location->name] as $lake){
                    $l = Lake::create([
                        'name' => $lake
                    ]);
                    $location->lakes()->attach($l);
                }
            } else {
                $locations_data = Location::where('city_id', $location->city_id)
                    ->with('lakes')->get();
                if (count($locations_data)) {
                    foreach ($locations_data as $d) {
                        foreach ($d->lakes as $lk) {
                            $location->lakes()->attach($lk->id);
                        }
                    }
                }
            }
        }
    }
}
