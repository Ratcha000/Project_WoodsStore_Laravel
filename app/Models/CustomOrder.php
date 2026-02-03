<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomOrder extends Model
{
    //use HasFactory;

    protected $table = 'custom_orders';
    protected $primaryKey = 'Cusor_ID';

    protected $fillable = [
        'Customer_id', 
        'Product_Name', // ✅ ใช้แทน Customer_Name
        'Stock_ID',
        'SSN_Passport',
        'Cus_Width',
        'Cus_Height',
        'Cus_Thickness',
        'Cus_Quantity',
        'Used_Stock_Quantity',
        'Cus_Price',
        'Cus_Design',
        'Cus_Status'
    ];


    public function customer() // ✅ เปลี่ยนจาก Customers() เป็น customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id', 'Customer_id');
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'Stock_ID', 'SID');
    }

    public function carpenter()
    {
        return $this->belongsTo(Carpenter::class, 'SSN_Passport', 'SSN_Passport');
    }

    public function products()
    {
    return $this->hasMany(Product::class, 'Cusor_ID', 'Cusor_ID');
    }
}
