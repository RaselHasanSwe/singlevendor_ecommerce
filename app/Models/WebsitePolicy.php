<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsitePolicy extends Model
{
    use HasFactory;

    protected $fillable = [
        'privacy_policy',
        'terms_conditions',
        'cookies_policy',
        'return_policy',
        'disclaimer'
    ];
}
