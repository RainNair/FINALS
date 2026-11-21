<label for="transaction_number">Booking reference</label>
<input id="transaction_number" name="transaction_number" value="{{ old('transaction_number', $transaction->transaction_number ?? '') }}" required>

<label for="customer_name">Guest name</label>
<input id="customer_name" name="customer_name" value="{{ old('customer_name', $transaction->customer_name ?? '') }}" required>

<label for="customer_email">Guest email</label>
<input id="customer_email" type="email" name="customer_email" value="{{ old('customer_email', $transaction->customer_email ?? '') }}" required>

<label for="amount">Estimated bill / deposit</label>
<input id="amount" type="number" name="amount" min="0" step="0.01" value="{{ old('amount', $transaction->amount ?? '') }}" required>

<label for="transaction_date">Transaction date</label>
<input id="transaction_date" type="date" name="transaction_date" value="{{ old('transaction_date', isset($transaction) ? $transaction->transaction_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>

<label for="reservation_time">Reservation time</label>
<input id="reservation_time" type="time" name="reservation_time" value="{{ old('reservation_time', isset($transaction) ? $transaction->reservation_time->format('H:i') : '') }}" required>

<label for="guest_count">Number of guests</label>
<input id="guest_count" type="number" name="guest_count" min="1" max="50" value="{{ old('guest_count', $transaction->guest_count ?? 2) }}" required>

<label for="table_type">Table preference</label>
<select id="table_type" name="table_type" required>
    @foreach(['Standard table', 'Window table', 'Private booth', 'Outdoor table'] as $tableType)
        <option value="{{ $tableType }}" @selected(old('table_type', $transaction->table_type ?? 'Standard table') === $tableType)>{{ $tableType }}</option>
    @endforeach
</select>

@if(auth()->user()->isAdmin() && isset($transaction))
    <label for="status">Booking status</label>
    <select id="status" name="status" required>
        @foreach(['pending', 'completed', 'cancelled'] as $status)
            <option value="{{ $status }}" @selected(old('status', $transaction->status ?? 'pending') === $status)>{{ ucfirst($status) }}</option>
        @endforeach
    </select>
@elseif(isset($transaction))
    <label for="status">Booking status</label>
    @if($transaction->status === 'completed')
        <input type="hidden" name="status" value="completed">
        <p class="badge">Completed by restaurant admin</p>
    @else
        <select id="status" name="status">
            <option value="pending" @selected($transaction->status === 'pending')>Pending</option>
            <option value="cancelled" @selected($transaction->status === 'cancelled')>Cancel booking</option>
        </select>
    @endif
@else
    <input type="hidden" name="status" value="pending">
    <p class="muted">New bookings are automatically submitted as Pending.</p>
@endif

<label for="notes">Notes</label>
<textarea id="notes" name="notes" rows="5">{{ old('notes', $transaction->notes ?? '') }}</textarea>

<div class="form-actions"><button type="submit">{{ $submitLabel }}</button><a href="{{ route('transactions.index') }}">Cancel</a></div>
