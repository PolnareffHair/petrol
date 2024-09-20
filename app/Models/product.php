<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = 'products';
    use HasFactory;
    protected $fillable = [
        "product_id",
        "product_category_id",
        "product_price",
        "product_name_ua",
        "product_name_ru",
        "product_description_ua",
        "product_description_ru",
        "product_attributes",
        "product_img_links",
        "product_meta_ua",
        "product_meta_ru"
    ];
}