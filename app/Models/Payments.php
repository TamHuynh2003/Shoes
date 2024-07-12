<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'transaction_id',
        'amount',
        'order_info',
        'order_type',
        'response_code',
        'bank_code',
        'vnp_secure_hash'
    ];
}
