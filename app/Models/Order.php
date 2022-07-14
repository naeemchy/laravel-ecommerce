<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'paying_amount',
        'blnc_transection',
        'stripe_order_id',
        'subtotal',
        'shipping',
        'vat',
        'total',
        'payment_type',
        'status',
        'return_order',
        'month',
        'date',
        'year',
        'status_code',
    ];
}
