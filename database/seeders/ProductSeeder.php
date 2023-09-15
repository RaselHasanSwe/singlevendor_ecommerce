<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Models\ProductShipping;
use App\Models\ProductSize;
use App\Services\SlugService;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $slug = new SlugService();
        $images = [
            "dynamic-images/product/1691843442-64d77b72c3f4b.webp",
            "dynamic-images/product/1691843443-64d77b73092a2.webp",
            "dynamic-images/product/1691843443-64d77b7348351.webp",
            "dynamic-images/product/1691843443-64d77b7352a6b.webp",
            "dynamic-images/product/1691843443-64d77b7368353.webp",
            "dynamic-images/product/1691843444-64d77b74051b3.webp",
            "dynamic-images/product/1691843445-64d77b75b2903.webp",
            "dynamic-images/product/1691843445-64d77b75c65f2.webp",
            "dynamic-images/product/1691843446-64d77b76103c6.webp",
            "dynamic-images/product/1691843446-64d77b76365e0.webp",
            "dynamic-images/product/1691843446-64d77b76727e9.webp",
            "dynamic-images/product/1691843446-64d77b7689cf1.webp",
            "dynamic-images/product/1691843446-64d77b76ce70b.webp",
            "dynamic-images/product/1691843446-64d77b76f064c.webp",
            "dynamic-images/product/1691843447-64d77b7713272.webp",
            "dynamic-images/product/1691843447-64d77b775a914.webp",
            "dynamic-images/product/1691843447-64d77b7775f3c.webp",
            "dynamic-images/product/1691843447-64d77b7793198.webp",
            "dynamic-images/product/1691843447-64d77b77ac30e.webp",
            "dynamic-images/product/1691843447-64d77b77d1203.webp"
        ];

        $category = [1,2,3,4,5,6,7,8,9];

        foreach($category as $key => $item){
            for($i = 0; $i < 100; $i++){
                $name = fake()->sentence(7, true);
                $product = new Product();
                $product->name = $name;
                $product->sku = 'sku-'.$item.$i;
                $product->stock = fake()->randomElement([10, 20, 30, 40, 50]);
                $product->slug = $slug->create($name);
                $product->price = fake()->numberBetween(10, 500);
                $product->discount = fake()->numberBetween(0, 30);
                $product->discount_type = fake()->randomElement([1,2]);
                $product->category_id = $item;
                $product->sort_description = fake()->text(300);
                $product->thumbnail = fake()->randomElement($images);
                $product->full_description = fake()->text(700);
                $product->full_specfications = fake()->text(900);
                $product->status = 1;
                $product->brand_id = fake()->numberBetween(1, 6);
                $product->save();

                $proImg = [];
                for($j = 0; $j < 4; $j++){
                    $arr['product_id'] =  $product->id;
                    $arr['image'] = fake()->randomElement($images);
                    $proImg[] = $arr;
                }
                ProductImage::insert($proImg);

                $shipArr = [];
                for($ship = 1; $ship <= 2; $ship++){
                    $sArr['shipping_id'] = $ship;
                    $sArr['product_id'] = $product->id;
                    $sArr['price'] = fake()->numberBetween(50, 100);
                    $sArr['shipping_apply'] = fake()->numberBetween(1, 2);
                    $shipArr[] = $sArr;
                }
                ProductShipping::insert($shipArr);


            }
        }

        $sub_category = [1,2,3,4,5,6,7];

        foreach($sub_category as $key => $item){
            for($i = 0; $i < 100; $i++){
                $name = fake()->sentence(7, true);
                $product = new Product();
                $product->name = $name;
                $product->sku = 'sku-'.$item.$i;
                $product->stock = fake()->randomElement([10, 20, 30, 40, 50]);
                $product->slug = $slug->create($name);
                $product->price = fake()->numberBetween(10, 500);
                $product->discount = fake()->numberBetween(0, 30);
                $product->discount_type = fake()->randomElement([1,2]);
                $product->category_id = 1;
                $product->sub_category_id = $item;
                $product->sort_description = fake()->text(300);
                $product->thumbnail = fake()->randomElement($images);
                $product->full_description = fake()->text(700);
                $product->full_specfications = fake()->text(900);
                $product->status = 1;
                $product->brand_id = fake()->numberBetween(1, 6);
                $product->save();

                $proImg = [];
                for($j = 0; $j < 4; $j++){
                    $arr['product_id'] =  $product->id;
                    $arr['image'] = fake()->randomElement($images);
                    $proImg[] = $arr;
                }
                ProductImage::insert($proImg);

                $shipArr = [];
                for($ship = 1; $ship <= 2; $ship++){
                    $sArr['shipping_id'] = $ship;
                    $sArr['product_id'] = $product->id;
                    $sArr['price'] = fake()->numberBetween(50, 100);
                    $sArr['shipping_apply'] = fake()->numberBetween(1, 2);
                    $shipArr[] = $sArr;
                }
                ProductShipping::insert($shipArr);

            }
        }


        foreach($sub_category as $key => $item){
            $total = 0;
            for($inner = 1; $inner <= 4; $inner++){
                $total++;
                for($i = 0; $i < 100; $i++){
                    $name = fake()->sentence(7, true);
                    $product = new Product();
                    $product->name = $name;
                    $product->sku = 'sku-'.$item.$i;
                    $product->stock = fake()->randomElement([10, 20, 30, 40, 50]);
                    $product->slug = $slug->create($name);
                    $product->price = fake()->numberBetween(10, 500);
                    $product->discount = fake()->numberBetween(0, 30);
                    $product->discount_type = fake()->randomElement([1,2]);
                    $product->category_id = 1;
                    $product->sub_category_id = $item;
                    $product->inner_category_id = $total;
                    $product->sort_description = fake()->text(300);
                    $product->thumbnail = fake()->randomElement($images);
                    $product->full_description = fake()->text(700);
                    $product->full_specfications = fake()->text(900);
                    $product->status = 1;
                    $product->hot = fake()->randomElement([1,0]);
                    $product->recomend = fake()->randomElement([1,0]);
                    $product->brand_id = fake()->numberBetween(1, 6);
                    $product->save();

                    $proImg = [];
                    for($j = 0; $j < 4; $j++){
                        $arr['product_id'] =  $product->id;
                        $arr['image'] = fake()->randomElement($images);
                        $proImg[] = $arr;
                    }
                    ProductImage::insert($proImg);

                    $totalLoop = fake()->numberBetween(1, 5);

                    $colorArr = [];
                    for($c = 1; $c <= $totalLoop; $c++){
                        $arr4['product_id'] = $product->id;
                        $arr4['color_id'] = $c;
                        $colorArr[] = $arr4;
                    }
                    ProductColor::insert($colorArr);

                    $sizeArr = [];
                    for($s = 1; $s <= $totalLoop; $s++){
                        $arr5['product_id'] = $product->id;
                        $arr5['size_id'] = $s;
                        $sizeArr[] = $arr5;
                    }
                    ProductSize::insert($sizeArr);


                    $shipArr = [];
                    for($ship = 1; $ship <= 2; $ship++){
                        $sArr['shipping_id'] = $ship;
                        $sArr['product_id'] = $product->id;
                        $sArr['price'] = fake()->numberBetween(50, 100);
                        $sArr['shipping_apply'] = fake()->numberBetween(1, 2);
                        $shipArr[] = $sArr;
                    }
                    ProductShipping::insert($shipArr);


                }
            }
        }
    }
}
