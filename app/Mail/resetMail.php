<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class resetMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $encryptedEmail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $encryptedEmail)
    {
        $this->email = $email;
        $this->encryptedEmail = $encryptedEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Recuperar Contraseña')
            ->view('emails.resetPass');
    }
}
