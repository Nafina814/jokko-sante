<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InscriptionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Bienvenue sur Jokko Santé - Confirmation d'inscription",
            from: new Address('finabadji30@gmail.com', 'Jokko Santé'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.inscription-confirmation',
        );
    }
}