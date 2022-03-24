<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $newContactInfo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_newContactInfo)
    {
        // ora posso sfruttare la variabile all'interno alla view
        $this->newContactInfo=$_newContactInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Nuova mail da ". $this->newContactInfo->name)->view('mails.contactEmail');
    }
}
