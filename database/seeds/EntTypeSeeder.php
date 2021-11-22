<?php

use Illuminate\Database\Seeder;

class EntTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ent_types = collect(json_decode(file_get_contents(__DIR__. "/../Data/EntTypes.json")))->toArray();
        $ent_categories = App\EntCategory::all();
        foreach ($ent_categories as  $category) {
            foreach($ent_types[$category->name] as $type){
                $category->ent_types()->create([
                    'name' => $type
                ]); 
            }
        }
    }
}
