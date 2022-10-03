<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'travel_contact_message';

    static $rules = [
        'id_subject'    => 'required',
        'message'       => 'required',
    ];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_contact', 'id_subject', 'message'];

    public function contact()
    {
        return $this->hasMany('App\Contact', 'id_contact', 'id_contact');
    }
}
