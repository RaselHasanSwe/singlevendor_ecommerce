<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\HomeSlider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run()
    {
        $slider = [
            ['image' => 'dynamic-images/slider/1692345738-64df258a1192c.webp'],
            ['image' => 'dynamic-images/slider/1692345751-64df2597bf880.webp']
        ];

        HomeSlider::insert($slider);
    }
}
