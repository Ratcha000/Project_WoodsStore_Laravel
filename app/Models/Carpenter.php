<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carpenter extends Model
{
    protected $table = 'carpenters';

    protected $primaryKey = 'SSN_Passport';

    protected $fillable = [
        'Fname', 'Lname', 'Tel', 'Age', 'Address',
        'Salary_Type', 'Salary_Amount', 'Payment_Method',
        'Bonus', 'Benefits', 'SID'
    ];

    
    public function salary()
    {
        return $this->belongsTo(Salary::class, 'SID');
    }

    
    public function customOrders()
    {
        return $this->hasMany(CustomOrder::class, 'SSN_Passport');
    }
}
