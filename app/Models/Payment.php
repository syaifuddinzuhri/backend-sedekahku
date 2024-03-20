<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
