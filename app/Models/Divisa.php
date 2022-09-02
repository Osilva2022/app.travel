<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisa extends Model
{
    use HasFactory;
    protected $table = 'travel_divisa';

    public $timestamps = true;
    protected $primaryKey = 'id';
}
