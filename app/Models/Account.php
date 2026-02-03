<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'Cost_ID', 'Bill_ID', 'income', 'expense', 'tax_cal', 'Ac_date'
    ];

    public function cost()
    {
        return $this->belongsTo(Cost::class, 'Cost_ID');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'Bill_ID');
    }
}
