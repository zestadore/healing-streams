<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentMail extends Mailable
{
    use Queueable, SerializesModels;
    public $payment;

    public function __construct($payment)
    {
        $this->payment=$payment;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payment Link for Healing Streams',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mails.payment_mail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
