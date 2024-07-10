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
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Colors::class, 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class, 'size_id');
    }
}
