<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    public function run()
    {

        $shipings = [
           [
                'name' => 'Standard Shipping',
                'duration' => '2-4 days',
                'ship_to' => 1,
                'description' => 'Standard shipping take 2-4 days to ship product',
           ],
           [
                'name' => 'Fast Shipping',
                'duration' => '1-2 days',
                'ship_to' => 2,
                'description' => 'Fast shipping take 2-4 days to ship product',
            ]
        ];
        Shipping::insert($shipings);


    }
}
