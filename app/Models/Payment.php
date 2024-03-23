<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaction',
        'program_id',
        'payment_account_id',
        'nominal',
        'name',
        'phone',
        'notes',
        'status'
    ];

    /**
     * Get the program that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the payment_account that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment_account(): BelongsTo
    {
        return $this->belongsTo(PaymentAccount::class);
    }
}
