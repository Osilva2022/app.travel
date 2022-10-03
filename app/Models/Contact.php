<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contact extends Model
{

    protected $table = 'travel_contact_info';

    static $rules = [
        'email' => 'required|email',
        'firstname' => 'required',
        'lastname' => 'required',
        'zipcode' => 'required',
        'id_subject' => 'required',
        'message' => 'required',
        'g-recaptcha-response' => 'required|captcha',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['email', 'firstname', 'lastname', 'zipcode'];

    public function contactmessage()
    {
        return $this->hasMany('App\ContactMessage', 'id_contact', 'id_contact');
    }
}
