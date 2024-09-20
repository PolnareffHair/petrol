<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class call_me extends Model
{
    protected $fillable = ["phone_number", "question_text"];
    use HasFactory;
}
