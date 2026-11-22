<?php

namespace App\Mail;

use App\Models\PpdbApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PpdbStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    /**
     * Create a new message instance.
     */
    public function __construct(PpdbApplication $application)
    {
        $this->application = $application;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $statusText = $this->application->status === 'approved' 
            ? 'SELAMAT, PENDAFTARAN DITERIMA!' 
            : 'PEMBERITAHUAN STATUS PENDAFTARAN (DITOLAK)';

        return new Envelope(
            subject: "[SPMB RA AL-IKHWAN] {$statusText} - {$this->application->registration_number}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ppdb_status',
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
