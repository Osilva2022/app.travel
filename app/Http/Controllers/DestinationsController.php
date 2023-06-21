<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class DestinationsController extends Controller
{
    public function destinations($destination, Request $request)
    {

        $posts = DB::select("SELECT * FROM travel_posts_destination WHERE destination_slug = '$destination' ORDER BY post_date DESC;");
        $destinationposts = paginate($posts, 9)->onEachSide(0);
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination';");
        (!isset($destination_data[0])) ? abort(404) : '';
        $categories_data = returndata('categories');
        $destinations_data = returndata('destinations');
        $tag_data = returndata('tags');
        $review = true;
        if ($request->page && $request->page > 1) {
            $review = false;
        }
        metadatos(
            $destination_data[0]->meta_title,
            $destination_data[0]->meta_description,
            images($destination_data[0]->image),
            route('destinations', $destination_data[0]->slug),
            route('destinations', $destination_data[0]->slug)
        );
        return view('destinations.index', compact('destinationposts', 'tag_data', 'destinations_data', 'categories_data', 'destination_data', 'review', 'destination'));
    }
    public function destinations_feed($destination, Request $request)
    {
        dd("destination feed");
    }
}
