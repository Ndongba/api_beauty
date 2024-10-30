<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Reservation; // Assurez-vous d'importer le modèle Reservation
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailBeaute extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $mailData;
    public $reservation; // Ajoutez cette variable

    public function __construct(User $user, array $mailData, Reservation $reservation) // Ajoutez Reservation ici
    {
        $this->user = $user;
        $this->mailData = $mailData;
        $this->reservation = $reservation; // Assignez la réservation
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Beauté',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mailbeaute',
            with: [
                'user' => $this->user,
                'mailData' => $this->mailData,
                'reservation' => $this->reservation, // Ajoutez reservation ici
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
