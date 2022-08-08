<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAll extends Model
{
    use HasFactory;
    protected $table = 'travel_all_posts';
    public $timestamps = false;
}
