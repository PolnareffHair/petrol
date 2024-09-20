<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reviews extends Model
{
    protected $fillable = ["review_id", "user_id", "review_product_id", 'review_plus', 'review_minus', 'review_text', 'review_admin_answer'];

    use HasFactory;
}
