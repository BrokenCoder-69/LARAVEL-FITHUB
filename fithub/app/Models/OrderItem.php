<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
