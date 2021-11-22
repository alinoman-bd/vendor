<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CitySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(LakeSeeder::class);
        $this->call(RiverSeeder::class);
        $this->call(SeaSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(SeasonSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(PriceTypeSeeder::class);
        $this->call(PackageSeeder::class);

        $this->call(FacilitiesSeeder::class);
        // factory(App\User::class, 500)->create();
        $this->call(EntCategorySeeder::class);
        $this->call(EntTypeSeeder::class);
        $this->call(UsersTableSeeder::class);
        // $this->call(ResourceSeeder::class);
    }
}