<?php

use Illuminate\Database\Seeder;

class PriceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_types = json_decode(file_get_contents(__DIR__. "/../Data/PaymentTypes.json"));
        foreach ($payment_types->type as  $payment_type) {
           App\PriceType::create([
               'name' => $payment_type,
           ]);
        }
    }
}