<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'user_id', 'total_price', 'status', 'shipping_name', 'shipping_address', 'shipping_phone'
    ];

    // Define the relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
