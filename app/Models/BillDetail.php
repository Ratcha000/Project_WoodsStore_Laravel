<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class BillDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'BillDetail_ID';
    protected $fillable = ['Bill_ID', 'PID', 'Quantity', 'Price', 'Total_price'];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'Bill_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'PID');
    }
}
