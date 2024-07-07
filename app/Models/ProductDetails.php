<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $table = 'product_details';

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function color()
    {
        return $this->belongsTo(Colors::class);
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class);
    }
}
