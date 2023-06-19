<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class GuideController extends Controller
{
    public function guide(Request $request)
    {
        $category = 'things-to-do';
        $destination = 'puerto-vallarta';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }

        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination'");
        $id_location = (isset($destination_data[0])) ? $destination_data[0]->term_id : abort(404);

        $things_categories = DB::select("SELECT * FROM (
                                            SELECT td.category_id,
                                            dc.name, dc.slug, dc.color as category_color, td.location, dc.image_data,dc.image_alt, dc.description
                                            ,ROW_NUMBER() over(partition by td.category_id,td.location ORDER BY td.location DESC) as orden
                                            FROM travel_directory as td
                                            inner join travel_directory_category as dc on td.category_id = dc.term_id
                                            ) t
                                            WHERE t.orden = 1
                                            AND location = '$id_location'
                                            ORDER BY location, category_id;");
        if (is_null($things_categories)) {
            return redirect()->route('home');
        }
        metadatos(
            'Guide | Tribune Travel',
            "Guide. There is always something new to discover. Learn about the best spots you can visit to dine, sip, pamper yourself and have the best of times.",
            // "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/guide-tt.png",
            "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/11/tt.png",
            route('guide'),
            route('guide')
        );

        return view('guide.index', compact('category', 'categories_data', 'destinations_data', 'destination_data', 'destination', 'things_categories', 'destination'));
    }

    public function guide_category($destination, $category, Request $request)
    {
        $categories_data = returndata('categories');
        $things_category = DB::select("SELECT * FROM travel_directory_category WHERE slug = '$category';");
        $destinations_data = returndata('destinations');
        $directory_category_data = DB::select("SELECT * FROM travel_directory_category WHERE slug= '$category';");
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$destination'");
        $id_location = (isset($destination_data[0])) ? $destination_data[0]->term_id : abort(404);
        $id_category = (isset($directory_category_data[0])) ? $directory_category_data[0]->term_id : abort(404);
        $things_categories = DB::select("SELECT
                                                dc.term_id, dc.name as category, dc.slug as category_slug
                                            FROM
                                                travel_directory_category as dc,
                                            (SELECT * FROM (
                                            SELECT location, category_id
                                            ,ROW_NUMBER() over(partition by category_id, location ORDER BY location DESC) as orden
                                            FROM travel_directory
                                            ) t
                                            WHERE t.orden = 1
                                            AND location = $id_location) as q1 WHERE  dc.term_id = q1.category_id");
        $things_vip = DB::select("SELECT * FROM travel_directory WHERE location = '$id_location' AND category_id = '$id_category' AND label = 22;");

        $selectedtletter = '';
        if (isset($request->letter)) {
            $selectedtletter = $request->letter;
        }
        //dd($request);
        $array_abc = array_merge(range('A', 'Z'));
        if (!in_array($selectedtletter, $array_abc) && isset($request->letter)) { //No es abc...
            $selectedtletter = '*';
        }
        foreach ($array_abc as $key => $val) {
            $newval = "'$val'";
            $array_abc[$key] = $newval;
        }
        $abc = implode(",", $array_abc);
        $alphachar = DB::select("SELECT
                                    CASE
                                        WHEN letter not in($abc) THEN '*'
                                        ELSE letter
                                    END as letter_n
                                FROM
                                    travel_directory
                                WHERE
                                    location = '$id_location' AND category_id = '$id_category'
                                GROUP BY letter_n
                                ORDER BY letter_n ASC;");
        if (isset($request->letter)) {
            $things = DB::select("SELECT
                                    *
                                FROM
                                    (SELECT
                                        *,
                                        CASE
                                            WHEN letter not in($abc) THEN '*'
                                            ELSE letter
                                        END as letters
                                    FROM
                                        travel_directory
                                    WHERE
                                        location = '$id_location' AND category_id = '$id_category') as q1
                                WHERE
                                    letters = '$selectedtletter'
                                ORDER BY post_title ASC;");
        } else {
            $things = DB::select("SELECT
                                    *
                                    FROM
                                        travel_directory
                                    WHERE
                                        location = '$id_location' AND category_id = '$id_category'
                                ORDER BY post_title ASC;");
        }
        if (is_null($things)) {
            return redirect()->route('home');
        }
        $gallery = get_img_gallery($id_location, $id_category);
        $guide_tags = GetTagsPosts($things);
        $metatitle = $destination_data[0]->name;
        metadatos(
            isset($things_category[0]->meta_title) ? $things_category[0]->name . ' in ' . $destination_data[0]->name : config('constants.META_TITLE'),
            isset($things_category[0]->meta_description) ? $things_category[0]->name . ' in ' . $destination_data[0]->name . ' ' . $things_category[0]->meta_description : config('constants.META_DESCRIPTION'),
            isset($things_category[0]->image) ? images($things_category[0]->image) : config('constants.DEFAULT_IMAGE'),
            route('guide_category', [$destination_data[0]->slug, $things_category[0]->slug]),
            route('guide_category', [$destination_data[0]->slug, $things_category[0]->slug])
        );
        return view('guide.guide_category', compact('category', 'destination', 'categories_data', 'destinations_data', 'destination_data', 'things', 'gallery', 'things_vip', 'things_category', 'things_categories', 'alphachar', 'selectedtletter', 'guide_tags'));
    }

    public function ShowGuideItem(Request $request)
    {
        if (isset($request->id)) {
            $id = $request->id;

            $directory_item = DB::select("SELECT * FROM travel_directory WHERE ID = $id;");

            if (is_null($directory_item)) {
                // return abort(404);
                return redirect()->route('home');
            }
            $data = $directory_item[0];
            $gallery = [];
            $imgs = [];
            $post_gallery = unserialize($data->gallery);
            foreach ($post_gallery as $key) {
                $info = DB::select("SELECT
                                        meta_value AS img
                                    FROM
                                        tribunetravel_wp.travel_postmeta
                                    WHERE
                                        post_id = $key
                                            AND meta_key = '_wp_attached_file';");
                array_push($imgs, $info[0]->img);
            }
            $gallery["gallery-" . $data->ID] = $imgs;
            return view('guide.directory_item', compact('data', 'gallery'));
        }
        /* return $request->id; */
    }

}
