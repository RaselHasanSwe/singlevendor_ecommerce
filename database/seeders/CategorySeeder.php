<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Services\SlugService;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $slug = new SlugService();
        $category = [
            ["name" => 'Womens & Girls Fashion', 'icon' => "<i class=\"fa fa-female\"></i>"],
            ["name" => 'Health & Beauty', 'icon' => "<i class=\"fa fa-medkit\"></i>"],
            ["name" => 'Watches, Bags, Jewellery', 'icon' => "<i class=\"fa fa-shopping-bag\"></i>"],
            ["name" => 'Mens & Boys Fashion', 'icon' => "<i class=\"fa fa-user\"></i>"],
            ["name" => 'Mother & Baby', 'icon' => "<i class=\"fa fa-heartbeat\"></i>"],
            ["name" => 'Electronics Devices', 'icon' => "<i class=\"fa fa-tablet\"></i>"],
            ["name" => 'TV & Home Appliances', 'icon' => "<i class=\"fa fa-television\"></i>"],
            ["name" => 'Electronic Accessories', 'icon' => "<i class=\"fa fa-bus\"></i>"],
            ["name" => 'Home & Lifestyle', 'icon' => "<i class=\"fa fa-home\"></i>"],
        ];

        foreach($category as $value){

                $arr['name'] = $value['name'];
                $arr['slug'] = $slug->create($value['name']);
                $arr['icon'] = $value['icon'];
                Category::create($arr);

        }
    }
}
