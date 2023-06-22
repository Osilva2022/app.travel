<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;

class DailyBriefingController extends Controller
{
    public function dailyBriefing()
    {
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $things_categories = DB::select("SELECT * FROM (
            SELECT td.category_id,
            dc.name, dc.slug, dc.color as category_color, td.location, dc.image_data,dc.image_alt, dc.description
            ,ROW_NUMBER() over(partition by td.category_id,td.location ORDER BY td.location DESC) as orden
            FROM travel_directory as td
            inner join travel_directory_category as dc on td.category_id = dc.term_id
            ) t
            WHERE t.orden = 1
            AND location = '4'
            ORDER BY location, category_id
            Limit 8;");

        metadatos(
            'Daily Briefing | Tribune Travel',
            "Daily Briefing. Today's top news by Tribune Travel",
            // "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/guide-tt.png",
            "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/11/tt.png",
            route('daily'),
            route('daily')
        );
        return view('categories.daily', compact('destinations_data', 'categories_data', 'things_categories'));
    }
}
