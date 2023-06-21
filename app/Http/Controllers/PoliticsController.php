<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoliticsController extends Controller
{
    public function cookies()
    {
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        metadatos(
            'Cookies Policy | Tribune Travel',
            "Cookies Policy",
            "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/11/tt.png",
            // "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/policy-tt.png",
            route('cookies'),
            route('cookies')
        );
        return view('policies.cookies', compact('destinations_data', 'categories_data'));
    }

    public function privacy()
    {
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        metadatos(
            'Privacy Policy | Tribune Travel',
            "Privacy Policy",
            "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/11/tt.png",
            // "https://s3.us-west-2.amazonaws.com/app.tribunetravel/2022/10/policy-tt.png",
            route('privacy'),
            route('privacy')
        );
        return view('policies.privacy', compact('destinations_data', 'categories_data'));
    }

    public function sitemap()
    {
        $destinations_data = returndata('destinations');
        $categories_data = returndata('categories');
        $tags_data = returndata('tags');

        metadatos(
            'Tribune Travel | Sitemap',
            'Sitemap ' . config('constants.META_DESCRIPTION'),
            config('constants.DEFAULT_IMAGE'),
            route('sitemap'),
            route('sitemap')
        );
        return view('sitemap.index', compact('destinations_data', 'categories_data', 'tags_data'));
    }
}
