<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; 
    protected $primaryKey = 'Order_ID'; 
    protected $fillable = [
        'Customer_id', 
        'Total_price', 
        'Status'
    ];

    // ความสัมพันธ์กับตาราง Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id', 'Customer_id');
    }

    // ความสัมพันธ์กับ OrderDetail (คำสั่งซื้อละเอียด)
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'Order_ID', 'Order_ID');
    }

    // ความสัมพันธ์กับ Delivery
    public function delivery()
    {
        return $this->hasOne(Delivery::class, 'Order_ID', 'Order_ID');
    }

    public function bill()
{
    return $this->hasOne(Bill::class, 'Order_ID');
}
}
