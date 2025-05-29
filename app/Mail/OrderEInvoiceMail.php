<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderEInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $kodeTransaksi;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order->load(['wedding.template.category', 'wedding.music']);
        $this->kodeTransaksi = $order->kode_transaksi;
    }

    public function build()
    {
        return $this->subject('Struk Pemesanan Undangan Digital - NgondangIn')
                    ->view('emails.order_einvoice');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bukti Pemesanan Undangan Digital - Kode Transaksi : '.$this->kodeTransaksi,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_einvoice',
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
