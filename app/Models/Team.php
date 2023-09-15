<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'designation',
        'sort_description',
        'fb',
        'tw',
        'ln',
        'gp'
    ];
}
