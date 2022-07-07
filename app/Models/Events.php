<?php

namespace App\Models;
use Corcel\Model;

class Events extends Model
{
    /**
     * @var string
     */
    protected $table = 'posts';
    protected $postType = 'tribe_events';
}