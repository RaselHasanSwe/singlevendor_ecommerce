<?php

namespace Database\Seeders;

use App\Models\InnerCategory;
use App\Models\SubCategory;
use App\Services\SlugService;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    public function run()
    {
        $slug = new SlugService();

        $sub_category = [
            ["name" => 'Traditional Wear', 'category_id' => 1],
            ["name" => 'Muslim Wear', 'category_id' => 1],
            ["name" => 'Western Wear', 'category_id' => 1],
            ["name" => 'Innerwear', 'category_id' => 1],
            ["name" => 'Shoes', 'category_id' => 1],
            ["name" => 'Bags', 'category_id' => 1],
            ["name" => 'Watches', 'category_id' => 1],
        ];

        foreach($sub_category as $value){
            $arr['name'] = $value['name'];
            $arr['slug'] = $slug->create($value['name']);
            $arr['category_id'] = $value['category_id'];
            SubCategory::create($arr);
         }

        $inner_category = [
            ["name" => 'Shalwar Kameez', 'category_id' => 1, 'sub_category_id' => 1],
            ["name" => 'Sarees', 'category_id' => 1, 'sub_category_id' => 1],
            ["name" => 'Kurtis', 'category_id' => 1, 'sub_category_id' => 1],
            ["name" => 'Unstitched Fabric', 'category_id' => 1, 'sub_category_id' => 1],


            ["name" => 'Abayas & Long Dresses', 'category_id' => 1, 'sub_category_id' => 2],
            ["name" => 'Hijabs', 'category_id' => 1, 'sub_category_id' => 2],
            ["name" => 'Brooches', 'category_id' => 1, 'sub_category_id' => 2],
            ["name" => 'Party Kameez & Gowns', 'category_id' => 1, 'sub_category_id' => 2],

            ["name" => 'Dresses', 'category_id' => 1, 'sub_category_id' => 3],
            ["name" => 'Tunics', 'category_id' => 1, 'sub_category_id' => 3],
            ["name" => 'T-Shirts', 'category_id' => 1, 'sub_category_id' => 3],
            ["name" => 'Tops', 'category_id' => 1, 'sub_category_id' => 3],


            ["name" => 'Bras', 'category_id' => 1, 'sub_category_id' => 4],
            ["name" => 'Lingerie Sets', 'category_id' => 1, 'sub_category_id' => 4],
            ["name" => 'Panties', 'category_id' => 1, 'sub_category_id' => 4],
            ["name" => 'Robes & Bodysuits', 'category_id' => 1, 'sub_category_id' => 4],



            ["name" => 'Heels', 'category_id' => 1, 'sub_category_id' => 5],
            ["name" => 'Flats', 'category_id' => 1, 'sub_category_id' => 5],
            ["name" => 'Sneakers', 'category_id' => 1, 'sub_category_id' => 5],
            ["name" => 'Pump Shoes', 'category_id' => 1, 'sub_category_id' => 5],

            ["name" => 'Crossbody & Bags', 'category_id' => 1, 'sub_category_id' => 6],
            ["name" => 'Backpacks', 'category_id' => 1, 'sub_category_id' => 6],
            ["name" => 'Wallets', 'category_id' => 1, 'sub_category_id' => 6],
            ["name" => 'Top Handle Bags', 'category_id' => 1, 'sub_category_id' => 6],


            ["name" => 'Casual', 'category_id' => 1, 'sub_category_id' => 7],
            ["name" => 'Fashion', 'category_id' => 1, 'sub_category_id' => 7],
            ["name" => 'Business', 'category_id' => 1, 'sub_category_id' => 7],
            ["name" => 'Sports', 'category_id' => 1, 'sub_category_id' => 7],


        ];

        foreach($inner_category as $value){
            $arr['name'] = $value['name'];
            $arr['slug'] = $slug->create($value['name']);
            $arr['category_id'] = $value['category_id'];
            $arr['sub_category_id'] = $value['sub_category_id'];
            InnerCategory::create($arr);
        }
    }
}
