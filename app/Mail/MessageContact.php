<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageContact extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Nuevo mensaje de Web www.presenzaprop.com.ar';
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.message-contact');
    }
}
