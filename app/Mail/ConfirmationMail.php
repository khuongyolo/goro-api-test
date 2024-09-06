<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $mailKind;
    public $login_url;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $mailKind)
    {
        $this->mailData = $mailData;
        $this->mailKind = $mailKind;
        $this->login_url = config('const.URL.LOGIN');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = '';
        switch ($this->mailKind) {
            case 'register':
                $subject = '【' . config('const.SYS_NAME') . '】REGISTION';
                break;
            case 'update':
                $subject = '【' . config('const.SYS_NAME') . '】UPDATE';
                break;
            case 'delete':
                $subject = '【' . config('const.SYS_NAME') . '】DELETE';
                break;
        }

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = '';
        switch ($this->mailKind) {
            case 'register':
                $view = 'mail.register';
                break;
            case 'update':
                $view = 'mail.update';
                break;
            case 'delete':
                $view = 'mail.delete';
                break;
        }
        return new Content(
            view: $view,
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
