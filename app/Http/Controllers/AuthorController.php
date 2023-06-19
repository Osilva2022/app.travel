<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function author($author_id)
    {
        $author_info = DB::select("SELECT * FROM travel_users_info WHERE user_nicename = '$author_id';");
        if (!isset($author_info[0])) {
            return redirect()->route('home');
        }
        // $posts_info = DB::select("SELECT * FROM travel_posts_all WHERE user_nicename = '$author_id' ORDER BY post_date DESC;");
        $posts_info = DB::select("SELECT
                                        pd.*
                                    FROM
                                        travel_posts_destination AS pd
                                            JOIN
                                        travel_users_info as ui ON ui.ID = pd.author_id
                                        WHERE ui.user_nicename = '$author_id'
                                    ORDER BY post_date DESC;");
        $author = $author_info[0];
        $no_posts = count($posts_info);
        $posts = paginate($posts_info, 6)->onEachSide(0);
        $categories_data = returndata('categories');
        $destinations_data = returndata('destinations');
        $tag_data = returndata('tags');
        metadatos(
            $author_info[0]->display_name . ' | Tribune Travel',
            isset($author_info[0]->description) ? $author_info[0]->description : config('constants.META_DESCRIPTION'),
            config('constants.DEFAULT_IMAGE'),
            route('author', $author_info[0]->user_nicename),
            route('author', $author_info[0]->user_nicename)
        );

        return view('authors.index', compact('posts', 'tag_data', 'destinations_data', 'categories_data', 'author', 'no_posts'));
    }
}
