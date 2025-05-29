<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PaymentEInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $kodeTransaksi;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order->load(['payment.paymentDest', 'payment.order']);
        $this->kodeTransaksi = $order->kode_transaksi;
    }

    public function build()
    {
        return $this->subject('Bukti Pembayaran Anda - NgondangIn')
                    ->view('emails.payment_einvoice');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bukti Pembayaran Undangan Digital - Kode Transaksi : '.$this->kodeTransaksi,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payment_einvoice',
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
