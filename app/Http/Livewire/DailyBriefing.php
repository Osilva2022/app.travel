<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DailyBriefing extends Component
{
    public $date = '', $posts = [];
    protected $queryString = [
        'date' => ['except' => '']
    ];

    protected $listeners = ["setDate" => 'setDate'];

    public function render()
    {
        if ($this->date == '') {
            $this->date = date('Y-m-d');
        }
        // dd($this->date);
        $this->posts = json_decode(file_get_contents('https://admin.tribune.travel/wp-json/wp/v2/posts?include_daily=1&_embed&per_page=5&after=' . $this->date . 'T00:00:00&before=' . $this->date . 'T23:59:59'));
        // $this->setDate();
        return view('livewire.daily-briefing');
    }

    function setDate($date)
    {
        $this->date = $date;
        $filter_date = '';
        if (isset($this->date)) {
            $filter_date = '&after=' . $this->date . 'T00:00:00&before=' . $this->date . 'T23:59:59';
        }

        $this->posts = json_decode(file_get_contents('https://admin.tribune.travel/wp-json/wp/v2/posts?include_daily=1&_embed&per_page=5' . $filter_date));
        // dd($this->posts);
    }
}
