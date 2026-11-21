<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    public function __construct(public Transaction $transaction, public string $event = 'created')
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Transaction '.ucfirst($this->event).': '.$this->transaction->transaction_number)
            ->greeting('Transaction system notification')
            ->line('A transaction was '.$this->event.'.')
            ->line('Transaction number: '.$this->transaction->transaction_number)
            ->line('Customer: '.$this->transaction->customer_name)
            ->line('Amount: '.$this->transaction->amount)
            ->line('Status: '.ucfirst($this->transaction->status));
    }
}
