<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostsController;

class EventController extends Controller
{
    public function event($destination, $slug)
    {

        $posts = new PostsController;
        $destinations_data = $posts->returndata('destinations');
        $categories_data = $posts->returndata('categories');
        $category = "Events";
        $apiresponse = json_decode(file_get_contents('https://admin.tribune.travel/wp-json/wp/v2/tribe_events?slug='. $slug.'&_embed'));
        empty($apiresponse) || $apiresponse[0]->status != "publish" ? abort(404) : true;
        $events = $apiresponse;
        $m_e = DB::select("SELECT * FROM travel_events WHERE start_date >= current_date() and slug != '$slug' ORDER BY start_date ASC;");
        $more_events = $posts->paginate($m_e, 3)->onEachSide(0);
        $id = $events[0]->id;
        $post_tags = DB::select("SELECT
                tags.name, tags.slug, tags.description, tags.color
            FROM
                travel_tags AS tags,
                (SELECT
                    `t`.`slug` AS `tag_slug`, `tr`.`object_id` AS `id_post`
                FROM
                    `travel_terms` `t`
                JOIN `travel_term_taxonomy` `tt`
                JOIN `travel_term_relationships` `tr`
                WHERE
                    `t`.`term_id` = `tt`.`term_id`
                        AND `tt`.`taxonomy` = 'post_tag'
                        AND `tr`.`term_taxonomy_id` = `tt`.`term_taxonomy_id`) AS posts_tags
            WHERE
                tags.slug = posts_tags.tag_slug
                    AND id_post = $id;");
                    
        return view('categories.event', compact('events', 'categories_data', 'destinations_data', 'more_events',  'post_tags', 'category', 'slug', 'destination'));
    }
}
