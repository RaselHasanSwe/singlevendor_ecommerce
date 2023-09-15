<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_name',
        'website_email',
        'website_phone',
        'website_address',
        'website_contact_us',
        'website_about_us',
        'happy_customer_background_image',
        'website_working_hours',
        'website_logo',
        'website_favicon',
        'fb',
        'tw',
        'ins',
        'gp',
        'yt',
        'section_1_title',
        'section_1_sort_title',
        'section_1_icon',
        'section_2_title',
        'section_2_sort_title',
        'section_2_icon',
        'section_3_title',
        'section_3_sort_title',
        'section_3_icon',
        'invoice_aditional',
    ];
}
