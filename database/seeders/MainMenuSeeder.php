<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\HomeSlider;
use App\Models\MainMneu;
use Illuminate\Database\Seeder;

class MainMenuSeeder extends Seeder
{
    public function run()
    {
        $mainMenu = [
            ['name' => 'Shalwar Kameez', 'slug'=>'/shop/womens-girls-fashion/traditional-wear/shalwar-kameez', 'category_id' => 1, 'status'=> 3],
            ['name' => 'Sarees', 'slug'=>'/shop/womens-girls-fashion/traditional-wear/sarees', 'category_id' => 2, 'status'=> 3],
            ['name' => 'Kurtis', 'slug'=>'/shop/womens-girls-fashion/traditional-wear/kurtis', 'category_id' => 3, 'status'=>3 ],
            ['name' => 'Unstitched Fabric', 'slug'=>'/shop/womens-girls-fashion/traditional-wear/unstitched-fabric', 'category_id' => 4, 'status'=> 3],
            ['name' => 'Bags', 'slug'=>'/shop/womens-girls-fashion/bags-2', 'category_id'=> 6, 'status'=> 2],
        ];

        MainMneu::insert($mainMenu);
    }
}
