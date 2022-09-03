<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Divisa;
use DB;

class Divisas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'divisa:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtener el tipo de cambios de las monedas EUR,CAD,USA,MXN';

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
        $curl = curl_init();
        $end_date=date('Y-m-d');
        $start_date=date('Y-m-d',strtotime("-1 days"));        

        curl_setopt_array($curl, array(
           CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/fluctuation?base=USD&start_date=$start_date&end_date=$end_date&symbols=CAD,MXN,EUR",
           CURLOPT_HTTPHEADER => array(
             "Content-Type: text/plain",
             "apikey: V0UApTVlnDOMo62k80m0YvA0ddjpdS8j"
           ),
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_ENCODING => "",
           CURLOPT_MAXREDIRS => 10,
           CURLOPT_TIMEOUT => 0,
           CURLOPT_FOLLOWLOCATION => true,
           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => "GET"
        ));
         
        $response = curl_exec($curl);         
        curl_close($curl);     

        $changes = json_decode($response, true);       
        $rates = $changes['rates']; 
        
        foreach ($rates as $key => $value) {           

            Divisa::where('country',$key)
                ->update(['end_date'=>$changes["end_date"],
                    'start_date'=>$changes["start_date"],              
                    'start_rate'=>$value["start_rate"],
                    'end_rate'=>$value["end_rate"],
                    'change'=>$value["change"]
                ]);
        }
        return 0;
    }
}
