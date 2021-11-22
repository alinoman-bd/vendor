<?php

use App\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['VIP 1', 200, '1 Year', 'Lorem ipsum dolor sit amet', NULL, NULL,],
            ['VIP 2', 100, '1 Year', 'Lorem ipsum dolor sit amet', NULL, NULL],
            ['Free', 0, NULL, NULL, NULL, NULL]
        ];

        foreach ($data as  $package) {

            Package::create([
                'name' => $package[0],
                'price' => $package[1],
                'duration' => $package[2],
                'description' => $package[3],
            ]);
        }
    }
}
