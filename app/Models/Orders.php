<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'order_date',
        'address',
        'phone_number',
        'shipping_cost',
        'users_id',
        'admins_id',
        'discount_id',
        'payment_methods_id',
        'payments_id',
        'status_id',
        'payment_status',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function admins()
    {
        return $this->belongsTo(Admins::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discounts::class);
    }

    public function payment_methods()
    {
        return $this->belongsTo(PaymentMethods::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStates::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetails::class)->with('product');
    }
}
