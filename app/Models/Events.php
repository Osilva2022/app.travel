<?php

namespace App\Models;

class Events extends Taxonomy
{
    /**
     * @var string
     */
    protected $table = 'posts';
    protected $postType = 'tribe_events';
}