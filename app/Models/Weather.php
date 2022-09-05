<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;
    protected $table = 'travel_weather';

    public $timestamps = true;
    protected $primaryKey = 'idtravel_weather';
}
