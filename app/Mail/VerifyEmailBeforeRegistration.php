<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailVerificationToken;

class VerifyEmailBeforeRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationToken;

    public function __construct(EmailVerificationToken $verificationToken)
    {
        $this->verificationToken = $verificationToken;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verificar Email - Sunny Class',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-email-before-registration',
        );
    }
}