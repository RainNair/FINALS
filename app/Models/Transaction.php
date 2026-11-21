<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'transaction_number',
        'customer_name',
        'customer_email',
        'amount',
        'transaction_date',
        'reservation_time',
        'guest_count',
        'table_type',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
            'reservation_time' => 'datetime:H:i',
            'guest_count' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
