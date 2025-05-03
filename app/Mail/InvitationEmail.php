<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $guest;
    public $event;

    public function __construct($guest, $event)
    {
        $this->guest = $guest;
        $this->event = $event;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Invitation to ' . $this->event->name,
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.invitation',
            with: [
                'guest' => $this->guest,
                'event' => $this->event,
            ],
        );
    }
} 