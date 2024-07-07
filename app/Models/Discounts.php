<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;

    protected $table = 'discounts';

    protected $fillable = [
        'name',
        'amount',
        'type_discounts_id',
        'start_date',
        'end_date',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function type_discounts()
    {
        return $this->belongsTo(TypeDiscounts::class);
    }
}
