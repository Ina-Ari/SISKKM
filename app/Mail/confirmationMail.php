<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class confirmationMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $msg;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($msg, $subject)
    {
        $this->msg = $msg;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject, // Menyertakan subject yang diterima di constructor
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Menyertakan pesan (msg) ke dalam data view
        return new Content(
            view: 'mailConfirmation', // Nama view yang akan digunakan
            with: [
                'msg' => $this->msg,   // Mengirimkan data pesan ke view
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
