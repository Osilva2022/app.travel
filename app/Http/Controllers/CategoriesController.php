<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function categories(Request $request, $category)
    {
        
        $destination = '';
        if (isset($request->destination)) {
            $destination = $request->destination;
        }
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');

        $firstpostcategory = category($category, $destination)->first();
        $postscategory = category($category, $destination);
        $category_data = DB::select("SELECT * FROM travel_categories WHERE slug = '$category';");
        (!isset($category_data[0])) ? abort(404) : '';
        switch ($category) {
            case 'things-to-do':
                $img = "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/things-tt.png";
                break;
            case 'news':
                $img = "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/news-tt.png";
                break;
            case 'reviews':
                $img = "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/reviews-tt.png";
                break;
            case 'blogs':
                $img = "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/blogs-tt.png";
                break;
            default:
                $img = "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/news-tt.png";
                break;
        }
        $img = 'https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/11/tt.png';

        metadatos(
            $category_data[0]->meta_title,
            $category_data[0]->meta_description,
            config('constants.DEFAULT_IMAGE'),
            route('category', $category_data[0]->slug),
            route('category', $category_data[0]->slug),
            ($category == 'daily-briefing') ? true : false
        );

        return view('categories.index', compact('firstpostcategory', 'postscategory', 'category', 'categories_data', 'destinations_data', 'category_data', 'destination'));
    }
}
