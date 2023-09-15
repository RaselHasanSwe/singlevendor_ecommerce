<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\User::factory(100)->create();
        \App\Models\Contact::factory(200)->create();
        \App\Models\Color::factory(7)->create();
        \App\Models\Admin::factory(1)->create();
        $this->call(SizeSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(ShippingSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(WebsiteSettingSeeder::class);
        $this->call(MainMenuSeeder::class);
        $this->call(ProductSeeder::class);

    }
}
