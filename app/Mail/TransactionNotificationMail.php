<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Transaction $transaction, public string $event)
    {
    }

    public function envelope(): Envelope
    {
        $label = $this->event === 'completed' ? 'completed' : 'created';

        return new Envelope(subject: 'Transaction '.$label.': '.$this->transaction->reference_no);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.transactions.notification');
    }
}
