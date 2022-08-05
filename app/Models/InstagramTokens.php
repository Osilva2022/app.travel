<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstagramTokens extends Model
{
    use HasFactory;

    protected $table = 'travel_instagram_tokens';

    public $timestamps = true;
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $hidden = ['token'];
}
