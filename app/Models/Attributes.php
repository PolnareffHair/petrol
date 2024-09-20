<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{

    protected $fillable = ['atribute_values_ua', 'atribute_name_ru', 'atribute_values_ru', "atribute_ID", 'atribute_name_ua'];

    use HasFactory;
}
