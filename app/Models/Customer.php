<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model

{
    use HasFactory;
    
    protected $table = 'customers';
   protected $primaryKey = 'Customer_id';
    protected $fillable = [
        'Customer_name', 'Customer_email', 'Customer_phone', 
        'Customer_address', 'Customer_type', 'Status'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'Customer_id', 'Customer_id');
    }
}
