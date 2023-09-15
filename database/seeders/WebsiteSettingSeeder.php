<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    public function run()
    {
        $setting = [
            'website_name' => 'Galio',
            'website_email' => 'info@website.com',
            'website_phone' => '0123456789',
            'website_address' => '1234 - Bandit Tringi Aliquam Vitae. New York',
            'website_contact_us' => 'Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum formas human.',
            'website_working_hours' => 'Monday – Saturday:08AM – 22PM',
            'website_logo' => 'dynamic-images/website_setting/1692390533-64dfd485b8582.webp',
            'website_favicon' => 'dynamic-images/website_setting/1692390533-64dfd485b8cd1.webp',
            'fb' => 'https://www.facebook.com/',
            'tw' => 'https://twitter.com/',
            'ins' => 'https://www.instagram.com/',
            'gp' => 'https://console.cloud.google.com/',
            'yt' => 'https://youtube.com/',
            'section_1_title' => 'WORKING TIME',
            'section_1_sort_title' => 'Mon- Sun: 8.00 - 18.00',
            'section_1_icon' => 'fa fa-clock-o',
            'section_2_title' => 'FREE SHIPPING',
            'section_2_sort_title' => 'On order over $199',
            'section_2_icon' => 'fa fa-truck',
            'section_3_title' => 'MONEY BACK 100%',
            'section_3_sort_title' => 'Within 30 Days after delivery',
            'section_3_icon'  => 'fa fa-money'
        ];

        WebsiteSetting::create($setting);
    }
}
