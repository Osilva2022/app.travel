<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use App\Models\Post;
class Feed extends Model implements Feedable
{
    public function toFeedItem(): FeedItem
    {
        // return FeedItem::create()
        //     ->id($this->id)
        //     ->title($this->title)
        //     ->summary($this->summary)
        //     ->updated($this->updated_at)
        //     ->link($this->link)
        //     ->authorName($this->author)
        //     ->authorEmail($this->authorEmail);

        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->body)
            ->updated($this->updated_at)
            ->link($this->url)
            ->author($this->author->display_name);
    }

    public static function getFeedItems()
    {
        return Post::published()->where('post_type','post')->get();
    }
}
