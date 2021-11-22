<?php

use App\Sea;
use App\City;
use App\Type;
use App\User;
use App\Search;
use App\Facility;
use App\Resource;
use Faker\Factory;
use App\Searchable;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = json_decode(file_get_contents(__DIR__. "/../Data/Address.json"));
        $users = User::where('is_admin', 1)->get();
        $faker = Factory::create();
        $cities = City::with(['locations.lakes', 'locations.rivers'])->get();
        $seas = Sea::all();
        $types = Type::get();
        $facilities = Facility::get();
        foreach ($addresses as  $address) {
            $city = $cities->random(1)->first();
            if ($city->locations->count()) {
                $location = $city->locations->random(1)->first();
                $location_id = $location->id;
            } else {
                $location_id = null;
            }
            if ($location->lakes->count()) {
                $lake = $location->lakes->random(1)->first();
                $lake_id = $lake->id;
            } else {
                $lake_id = null;
            }
            if ($location->rivers->count()) {
                $river = $location->rivers->random(1)->first();
                $river_id = $river->id;
            } else {
                $river_id = null;
            }

            $sea = $seas->random(1)->first();

            $data = [
                "name" => $name = $faker->company,
                "user_id" => $users->random(1)->first()->id,
                "email" => $faker->email,
                "phone" => $address[3],
                "image" => '1616505240-resource.webp',
                "video" => '1616506567-video.mp4',
                "video_thumb" => '16165065671275965144-thumb.webp',
                "video_status" => 1,
                "short_title" => $faker->sentence($nbWords = 6, $variableNbWords = true),
                "nearest_locations" => $address[2],
                "address" => $address[0] .', '. $address[1],
                "number_of_rooms" => $less = \rand(10,50),
                "number_of_people" => \rand($less, $less + 30),
                "description" => $faker->sentence($nbWords = 10, $variableNbWords = true),
                "city_id" => $city->id,
                "location_id" => $location_id,
                "lake_id" => $lake_id,
                "river_id" => $river_id,
                "sea_id" => $sea->id,
                "min_price" => $less = \rand(10,50),
                "max_price" => $next = \rand($less, $less + 30),
                "total_min_price" => $max = \rand($next, $next + 30),
                "total_max_price" => \rand($max, $max + 30),
                "price_type_id" => \rand(1,2),
                "season_id" => \rand(1,2),
                "payment_type_id" => \rand(1,2),
                "is_active" => 1,
                "package_id" => \rand(1,3),
                "seo_title" => $name . 'seo title',
                "seo_tag" => $name . 'seo tag',
                "seo_keyword" => $name . 'seo keyword',
                "seo_description" => $name . 'seo description',
                "distance_from_lake" => \rand(10,100),
                "distance_from_river" => \rand(10,100),
                "distance_from_sea" => \rand(10,100),
                "contact_person" => $faker->name .' ' . $faker->email . ' ' . $faker->e164PhoneNumber,
                "note" => $faker->sentence($nbWords = 25, $variableNbWords = true),
            ];
            $resource = Resource::create($data);
            $type = $types->random(rand(1,5))->pluck('id');
            $resource->types()->attach($type);
            $facility = $facilities->random(rand(5,10))->pluck('id');
            $resource->facilities()->attach($facility);

            $search = new Search;
            $search->title = $resource->name;
            $search->short_title = $resource->short_title;
            $search->save();

            $searchable = new Searchable;
            $searchable->search_id = $search->id;
            $searchable->searchable_id = $resource->id;
            $searchable->searchable_type = get_class($resource);
            $searchable->save();
        }

    }
}