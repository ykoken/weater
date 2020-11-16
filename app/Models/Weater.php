<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weater extends Model
{
    protected $table = "cities_weater";
    protected $fillable = [
        'city_name',
        'weater',
    ];
}
