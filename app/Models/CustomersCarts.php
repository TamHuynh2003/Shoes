<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersCarts extends Model
{
    use HasFactory;

    protected $table = 'customer_carts';

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'products_id');
    }

    public function customer()
    {
        return $this->belongsTo(CustomersCarts::class);
    }

    public function product_detail()
    {
        return $this->belongsTo(ProductDetails::class)->with('product', 'color', 'size');
    }
}
