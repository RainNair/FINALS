<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Mail\TransactionProcessedMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(Request $request): View
    {
        $transactions = ($request->user()->isAdmin()
            ? Transaction::query()
            : $request->user()->transactions())
            ->latest('transaction_date')->latest('id')->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create(): View
    {
        return view('transactions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $validated['status'] = 'pending';
        $transaction = $request->user()->transactions()->create($validated);

        Log::info('Reservation created', [
            'booking' => $transaction->transaction_number,
            'guest' => $transaction->customer_name,
            'status' => $transaction->status,
            'actor' => $request->user()->email,
        ]);

        $this->sendCompletionEmail($transaction);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction): View
    {
        $transaction = $this->visibleTransaction(request(), $transaction);

        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction): View
    {
        $transaction = $this->visibleTransaction(request(), $transaction);

        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $transaction = $this->visibleTransaction($request, $transaction);
        $isAdmin = $request->user()->isAdmin();
        $validated = $request->validate($this->rules($transaction, $isAdmin));

        if (! $isAdmin) {
            $validated['status'] = $transaction->status !== 'completed'
                && $request->input('status') === 'cancelled'
                ? 'cancelled'
                : $transaction->status;
        }

        $transaction->update($validated);

        Log::info('Reservation updated', [
            'booking' => $transaction->transaction_number,
            'status' => $transaction->status,
            'actor' => $request->user()->email,
        ]);

        $this->sendCompletionEmail($transaction);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Request $request, Transaction $transaction): RedirectResponse
    {
        $transaction = $this->visibleTransaction($request, $transaction);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    private function rules(?Transaction $transaction = null, bool $admin = false): array
    {
        $unique = 'unique:transactions,transaction_number'.($transaction ? ','.$transaction->id : '');

        return [
            'transaction_number' => ['required', 'string', 'max:50', $unique],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'transaction_date' => ['required', 'date'],
            'reservation_time' => ['required', 'date_format:H:i'],
            'guest_count' => ['required', 'integer', 'min:1', 'max:50'],
            'table_type' => ['required', 'string', 'max:100'],
            'status' => $admin
                ? ['required', 'in:pending,completed,cancelled']
                : ['nullable', 'in:pending,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    private function sendCompletionEmail(Transaction $transaction): void
    {
        if (! $transaction->wasRecentlyCreated && ! $transaction->wasChanged('status')) {
            return;
        }

        Mail::to($transaction->customer_email)
            ->send(new TransactionProcessedMail($transaction));

        Log::channel('stderr')->info('Email notification sent', [
            'booking' => $transaction->transaction_number,
            'status' => $transaction->status,
            'recipient' => $transaction->customer_email,
        ]);
    }

    private function visibleTransaction(Request $request, Transaction $transaction): Transaction
    {
        return $request->user()->isAdmin()
            ? Transaction::findOrFail($transaction->id)
            : $request->user()->transactions()->findOrFail($transaction->id);
    }

}
