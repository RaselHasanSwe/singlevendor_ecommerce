<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run()
    {
        $sizes = [
            ['name' => 'Adidas'],
            ['name' => 'Google'],
            ['name' => 'Apple'],
            ['name' => 'Amazon'],
            ['name' => 'Nike'],
            ['name' => 'IBM']
        ];

        Brand::insert($sizes);
    }
}
