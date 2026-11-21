<x-mail::message>
# Reservation Status Update

Reservation **{{ $transaction->transaction_number }}** for **{{ $transaction->customer_name }}** is now **{{ ucfirst($transaction->status) }}**.

**Amount:** {{ number_format((float) $transaction->amount, 2) }}

**Transaction date:** {{ $transaction->transaction_date->format('F j, Y') }}

**Reservation time:** {{ $transaction->reservation_time->format('H:i') }}

<x-mail::button :url="route('transactions.show', $transaction)">
View Transaction
</x-mail::button>

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
