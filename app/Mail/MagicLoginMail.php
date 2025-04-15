<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MagicLoginMail extends Mailable
{
    use SerializesModels;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Connexion magique')
            ->view('emails.magic-login')
            ->with([
                'url' => route('magic.login.verify', ['token' => $this->token]),
            ]);
    }
}
