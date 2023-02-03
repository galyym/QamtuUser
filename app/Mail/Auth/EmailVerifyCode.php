<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerifyCode extends Mailable
{
    use Queueable, SerializesModels;

    protected $verification_code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verification_code)
    {
        $this->verification_code = $verification_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Qamtu")->view('email')->with("verify_code", $this->verification_code);
    }
}
