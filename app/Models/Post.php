<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Corcel\Model\Post as Corcel;


class Post extends Corcel 
{
    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';

    // protected $connection = 'wordpress';
    // protected $postType = 'post';

    /**
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $dates = ['post_date', 'post_date_gmt', 'post_modified', 'post_modified_gmt'];

    /**
     * @var array
     */
    protected $with = ['meta'];

    /**
     * @var array
     */
    protected static $postTypes = [];

    /**
     * @var array
     */
    protected $fillable = [
        'post_content',
        'post_title',
        'post_excerpt',
        'post_type',
        'to_ping',
        'pinged',
        'post_content_filtered',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'title',
        'slug',
        'content',
        'type',
        'mime_type',
        'url',
        'author_id',
        'parent_id',
        'created_at',
        'updated_at',
        'excerpt',
        'status',
        'image',
        'terms',
        'main_category',
        'keywords',
        'keywords_str',
    ];

    /**
     * @var array
     */
    protected static $aliases = [
        'title' => 'post_title',
        'content' => 'post_content',
        'excerpt' => 'post_excerpt',
        'slug' => 'post_name',
        'type' => 'post_type',
        'mime_type' => 'post_mime_type',
        'url' => 'guid',
        'author_id' => 'post_author',
        'parent_id' => 'post_parent',
        'created_at' => 'post_date',
        'updated_at' => 'post_modified',
        'status' => 'post_status',
    ]; 
    
   
}
