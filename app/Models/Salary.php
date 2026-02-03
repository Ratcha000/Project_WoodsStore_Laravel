<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salaries';

    protected $fillable = [
        'S_Type', 'S_Pay', 'S_Status'
    ];

    
    public function carpenters()
    {
        return $this->hasMany(Carpenter::class, 'SID');
    }
}
