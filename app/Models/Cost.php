<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cost extends Model
{
    //
    use HasFactory;

    protected $table = 'costs'; // ชื่อตารางในฐานข้อมูล

    protected $primaryKey = 'Cost_ID'; // กำหนด Primary Key

    protected $fillable = [
        'Cost_Type',
        'Expense_Date',
        'Description',
        'Carpenter_ID',
        'Wood_ID',
        'Quantity',
        'Unit_Cost',
        'Total_Cost',
        'Reference_No',
    ];

    // ความสัมพันธ์กับช่างไม้
    public function carpenter()
    {
        return $this->belongsTo(Carpenter::class, 'Carpenter_ID', 'SSN_Passport');
    }

    // ความสัมพันธ์กับไม้
    public function wood()
    {
        return $this->belongsTo(Wood::class, 'Wood_ID', 'WID');
    }
}
