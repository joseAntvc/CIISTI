<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use function Laravel\Prompts\alert;

class ComunicationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $users;

    /**
     * Create a new message instance.
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->users['title'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        alert($this->users['title']);
        return new Content(
            view: 'emails.comunication',
            with:[
                'users' => $this->users
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
