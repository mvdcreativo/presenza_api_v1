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
        $address = 'mvdcreativo@gmail.com';
        $subject = 'Nuevo mensaje desde la web presenzaprop.com.ar';
        // $name 'Web presenzaprop.com.ar';


        return $this->view('emails.message-contact')
        ->from($this->msg['email'] , $this->msg['name'] )
        // ->cc($address, $name)
        // ->bcc($address, $name)
        ->replyTo($this->msg['email'] , $this->msg['name'] )
        ->subject($subject)
        ->with($this->msg)
        ;
    }
}
