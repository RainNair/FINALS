<h2>Transaction {{ $event === 'completed' ? 'completed' : 'created' }}</h2>
<p>Reference: <strong>{{ $transaction->reference_no }}</strong></p>
<p>Customer: {{ $transaction->customer_name }}</p>
<p>Amount: ₱{{ number_format((float) $transaction->amount, 2) }}</p>
<p>Status: {{ ucfirst($transaction->status) }}</p>
<p>Date: {{ $transaction->transaction_date->format('F j, Y') }}</p>
<p>Thank you for using the transaction system.</p>
