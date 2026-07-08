<?php

namespace App\Mail;

use App\Models\Rendezvous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RendezvousAnnule extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Rendezvous $rendezvous) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '❌ Rendez-vous annulé — Jokko Santé',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.rendezvous-annule',
        );
    }
}
