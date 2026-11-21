@extends('layouts.app')
@section('content')
<div class="panel">
    <div class="hero"><h1>Restaurant reservations</h1><p>Welcome to Savoria. Manage your dining plans and reservation details in one place.</p></div>
    <div class="toolbar"><div><h2>{{ auth()->user()->isAdmin() ? 'All reservations' : 'My reservations' }}</h2><p class="muted">Complete reservation and transaction processing.</p></div><a class="button" href="{{ route('transactions.create') }}">Book a table</a></div>
    <table><thead><tr><th>Booking</th><th>Guest</th><th>Guests</th><th>Date & time</th><th>Status</th><th>Actions</th></tr></thead><tbody>
    @forelse($transactions as $transaction)
        <tr><td><a href="{{ route('transactions.show', $transaction) }}">{{ $transaction->transaction_number }}</a></td><td>{{ $transaction->customer_name }}</td><td>{{ $transaction->guest_count }}</td><td>{{ $transaction->transaction_date->format('M j, Y') }}<br><span class="muted">{{ $transaction->reservation_time->format('H:i') }}</span></td><td><span class="badge">{{ ucfirst($transaction->status) }}</span></td><td><a href="{{ route('transactions.edit', $transaction) }}">Edit</a> <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" style="display:inline">@csrf @method('DELETE')<button type="submit" onclick="return confirm('Delete this reservation?')">Delete</button></form></td></tr>
    @empty
        <tr><td colspan="6">No reservations have been recorded.</td></tr>
    @endforelse
    </tbody></table>
</div>
@endsection
