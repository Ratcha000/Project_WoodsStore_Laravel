<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //use HasFactory;
    use SoftDeletes;

    protected $table = 'products';

    protected $primaryKey = 'PID';

    protected $fillable = [
        'SID', 
        'Cusor_ID',
        'P_Name',
        'Price',
        'P_Width',
        'P_Height',
        'P_Thickness',
        'P_Quantity',
        'P_Status'
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'SID');
    }
    public function customOrder()
    {
        return $this->belongsTo(CustomOrder::class, 'Cusor_ID', 'Cusor_ID');
    }
}

