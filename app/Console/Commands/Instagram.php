<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InstagramTokens;
use EspressoDev\InstagramBasicDisplay\InstagramBasicDisplay;
use DB;

class Instagram extends Command
{
    
    protected $signature = 'instagram:task';
   
    protected $description = 'Generar token de acceso a la api de instagram cada mes';

    public function __construct()
    {
        parent::__construct();
    }
   
    public function handle()
    {
        //seccion refresacar tokens instagram 
        
        $instagramtoken = InstagramTokens::find(1);
        $tokenold = $instagramtoken->token;    
        $instagrambasic = new InstagramBasicDisplay($tokenold);
        

        $instagrambasic->setAccessToken($tokenold);        
        $token = $instagrambasic->refreshToken($tokenold,true);             
            
        $instagram = InstagramTokens::find(1);      
        $instagram->token = $token;
        $instagram->save();
        return 0;
    }
}
