<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Bill extends Model
{
    use HasFactory;

    protected $primaryKey = 'Bill_ID';
    protected $fillable = ['Order_ID', 'Customer_id', 'Total_price', 'VAT', 'Grand_total', 'Payment_status'];

    public function details()
    {
        return $this->hasMany(BillDetail::class, 'Bill_ID');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID');
    }
}
