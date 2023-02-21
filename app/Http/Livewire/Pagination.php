<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Illuminate\Support\Facades\DB;
use \App\Http\Controllers\PostsController;

class Pagination extends Component
{
    protected $paginationTheme = 'bootstrap';
    public $destination = "";
    public $things = "";
    public $category = "";
    public $letter = "";
    public $selectedtletter = "";
    public $alphachar = "";
    public $gallery = "";
    public $guide_tags = "";

    public function buscar_nombre($var = null)
    {
        $this->letter = $var;
    }

    public function render()
    {
        $directory_category_data = DB::select("SELECT * FROM travel_directory_category WHERE slug= '$this->category';");
        $destination_data = DB::select("SELECT * FROM travel_destinations WHERE slug = '$this->destination'");
        $id_location = (isset($destination_data[0])) ? $destination_data[0]->term_id : abort(404);
        $id_category = (isset($directory_category_data[0])) ? $directory_category_data[0]->term_id : abort(404);
        $subquery = '';
        if (isset($this->letter)) {
            $this->selectedtletter = $this->letter;
        }
        if ($this->selectedtletter != '') {
            $subquery = " AND post_title like '$this->selectedtletter%'";
        }

        $array_abc = array_merge(range('A', 'Z'));
        if (!in_array($this->selectedtletter, $array_abc) && isset($this->letter)) { //No es abc...
            $this->selectedtletter = '*';
        }
        foreach ($array_abc as $key => $val) {
            $newval = "'$val'";
            $array_abc[$key] = $newval;
        }
        $abc = implode(",", $array_abc);
        $this->alphachar = DB::select("SELECT
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
        $this->things = DB::select("SELECT
                                    *
                                    FROM
                                        travel_directory
                                    WHERE
                                        location = '$id_location' AND category_id = '$id_category'
                                        $subquery
                                    ORDER BY post_title ASC;");

        // dd($things);
        if (is_null($this->things)) {

            return redirect()->route('home');
        }
        $this->gallery = $this->get_img_gallery($id_location, $id_category);
        $this->guide_tags = $this->GetTagsPosts($this->things);
        return view('livewire.pagination');
    }

    public function GetTagsPosts($posts_list)
    {
        $array = [];
        foreach ($posts_list as $key) {
            array_push($array, $key->ID);
        }
        $list = implode(",", $array);
        $guide_tags = DB::select("SELECT
                                        t.term_id, t.name
                                    FROM
                                        travel_term_relationships AS tr,
                                        travel_term_taxonomy AS tt,
                                        travel_terms as t
                                    WHERE
                                        tr.term_taxonomy_id = tt.term_taxonomy_id
                                            AND tt.taxonomy = 'listdom-tag'
                                            AND tt.term_id = t.term_id
                                            AND tr.object_id IN ($list)
                                            GROUP BY t.term_id
                                            ORDER BY t.name;");
        return $guide_tags;
    }

    public function get_img_gallery($destination, $category)
    {
        $galleries = [];
        $posts = DB::select("SELECT * FROM travel_directory WHERE location = '$destination' AND category_id = '$category' AND label IN (21,22);");
        foreach ($posts as $post) {
            $imgs = [];
            $post_gallery = unserialize($post->gallery);
            foreach ($post_gallery as $key) {
                $data = DB::select("SELECT
                                        meta_value AS img
                                    FROM
                                        tribunetravel_wp.travel_postmeta
                                    WHERE
                                        post_id = $key
                                            AND meta_key = '_wp_attached_file';");
                array_push($imgs, $data[0]->img);
            }
            $galleries["gallery-" . $post->ID] = $imgs;
        }
        return $galleries;
    }
}
