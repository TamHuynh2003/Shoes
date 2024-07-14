<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'descriptions',
        'purchase_price',
        'selling_price',
        'rating',
        'categories_id',
        'providers_id',
    ];

    public function images()
    {
        return $this->hasMany(ProductImages::class, 'products_id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetails::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'categories_id');
    }

    public function providers()
    {
        return $this->belongsTo(Providers::class, 'providers_id');
    }

    public function availableSizes()
    {
        return $this->productDetails()->with('size')->get()->pluck('size')->unique('id');
    }

    public function availableColors()
    {
        return $this->productDetails()->with('color')->get()->pluck('color')->unique('id');
    }
}
