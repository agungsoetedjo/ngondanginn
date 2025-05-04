<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $userName, public $otp, public $otpDuration)
    {
        
    }

    public function build()
    {
        return $this->subject('Kode OTP Verifikasi Akun')
                    ->view('emails.otp')
                    ->with([
                    'userName' => $this->userName,
                    'otp' => $this->otp,
                    'otpDuration' => $this->otpDuration,
                    ]);
    }
    
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat Datang, '.$this->userName.' di NgondangIn! Verifikasi Akun Anda dengan Kode OTP',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.otp',
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
