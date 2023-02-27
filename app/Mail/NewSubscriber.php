<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSubscriber extends Mailable
{
    use Queueable, SerializesModels;

     /**
     * The demo object instance.
     *
     * @var new_subscriber
     */
    public $new_subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_subscriber)
    {
        $this->new_subscriber = $new_subscriber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@cps.media', 'Tribune Travel')->view('subscriptions.mail')->text('subscriptions.plain')->subject('Nuevo Mensaje - Tribune Travel');

    }
}
