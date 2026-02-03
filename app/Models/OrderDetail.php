<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    //
    use HasFactory;

    protected $table = 'order_details'; 
    protected $primaryKey = 'OrderDetail_ID'; 
    protected $fillable = [
        'Order_ID', 
        'PID', 
        'Quantity', 
        'Price'
    ];

    // ความสัมพันธ์กับ Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID', 'Order_ID');
    }

    // ความสัมพันธ์กับ Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'PID', 'PID');
    }
}
