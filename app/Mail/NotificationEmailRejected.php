<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmailRejected extends Mailable
{
    use Queueable, SerializesModels;
    public $id;

    /**
     * Create a new message instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notification Email Rejected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Pendaftaran Anda Diterima- PPDB SDN Purwosari 2')
            ->view('emails.notifikasi-ppdb-rejected')
            ->with(['id' => $this->id]);
    }
}
