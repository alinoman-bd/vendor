<?php

use Illuminate\Database\Seeder;


class EntCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ent_categories = json_decode(file_get_contents(__DIR__. "/../Data/EntCategories.json"));
       foreach ($ent_categories->ent_category as  $category) {
          App\EntCategory::create([ 
              'name' => $category,
          ]);
       }
    }
}
