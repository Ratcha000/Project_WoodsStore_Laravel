<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    //
    use HasFactory;

    protected $table = 'deliveries'; 
    protected $primaryKey = 'DID'; 
    protected $fillable = [
        'Order_ID', 
        'Customer_id', 
        'D_type', 
        'D_price', 
        'distance_km', 
        'extra_cost', 
        'Delivery_status', 
        'Delivery_date', 
        'Tracking_number'
    ];

    // ความสัมพันธ์กับ Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID', 'Order_ID');
    }

    // ความสัมพันธ์กับ Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id', 'Customer_id');
    }
   

}
