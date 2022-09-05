<?php

namespace App\Console\Commands;

use App\Models\Weather;
use Illuminate\Console\Command;
use DB;

class Weathers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weathers:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtener clima de los diferentes destinos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $clave = "axDaaqqzqaq72lm";
        $location_id = "54801"; //Vallarta
        $locations_weather = DB::select("SELECT * FROM travel_weather;");
        foreach ($locations_weather as $weather) {
            $location_id = $weather->idtravel_weather; //Vallarta
            $ContextOptionsWeather = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false));
            $WeatherJson = file_get_contents('https://api.tutiempo.net/json/?lan=en&apid=' . $clave . '&lid=' . $location_id . '', false, stream_context_create($ContextOptionsWeather));
            $WeatherArray = json_decode($WeatherJson, true);
            Weather::where('idtravel_weather', $location_id)
                ->update(['info' => $WeatherJson]);
        }
        return 0;
    }
}
