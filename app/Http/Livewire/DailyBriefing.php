<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DailyBriefing extends Component
{
    public $date = '';
    protected $queryString = [
        'date' => ['except' => '', 'as' => 'date']
    ];

    protected $listeners = ["setDate" => 'changeDate'];

    public function mount()
    {
        if ($this->date == '') {
            $this->date = date('Y-m-d');
        }
    }

    public function render()
    {
        // $filter_date = '&after=' . $this->date . 'T00:00:00&before=' . $this->date . 'T23:59:59';
        // dd($this->date);
        $posts = json_decode(file_get_contents('https://admin.tribune.travel/wp-json/wp/v2/posts?include_daily=1&_embed&per_page=5&after=' . $this->date . 'T00:00:00&before=' . $this->date . 'T23:59:59'));
        // dd($posts);
        return view('livewire.daily-briefing', compact('posts'));
    }

    public function changeDate($d)
    {
        $this->date = $d;
    }
}
