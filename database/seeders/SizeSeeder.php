<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    public function run()
    {
        $sizes = [
           ['name' => 'XS', 'measurement' => '16.5 X 27'],
           ['name' => 'S', 'measurement' => '18 X 28'],
           ['name' => 'M', 'measurement' => '20 X 29'],
           ['name' => 'L', 'measurement' => '22 X 30'],
           ['name' => 'XL', 'measurement' => '24 X 31'],
           ['name' => '2XL', 'measurement' => '26 X 32'],
           ['name' => '3XL', 'measurement' => '28 X 33']
        ];

        Size::insert($sizes);
    }
}
