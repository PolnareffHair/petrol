<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $fillable = [
        'country_name_ua',
        'country_name_ru',
        "country_id"
    ];

    use HasFactory;
}
