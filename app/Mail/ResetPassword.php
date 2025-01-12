<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct($url, $user)
    {
        $this->url = $url;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Permintaan Reset Kata Sandi - PPDB SDN Purwosari 2')
            ->view('emails.reset-password')
            ->with(['url' => $this->url]);
    }
}
