<?php

namespace App\Mail;

use App\Models\Award;
use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendAwardEmailToClient extends Mailable
{
    use Queueable, SerializesModels;


    public $client;
    public $award;

    public function __construct($client, $award)
    {
        $this->client = $client;
        $this->award = $award;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Parabéns você é uma pessoa de sorte',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.SendAwards ',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
