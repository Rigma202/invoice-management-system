<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Content;

class StaffCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $staff;
    public $password;

    public function __construct($staff, $password)
    {
        $this->staff = $staff;
        $this->password = $password;
    }

    /**
     * Define the email subject and metadata
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Staff Account Created'
        );
    }

    /**
     * Define the email view/content
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.staff_credentials'
        );
    }

}
