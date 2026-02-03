<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $table = 'stocks';

    protected $primaryKey = 'SID'; 

    protected $fillable = ['WID', 'S_Name', 'S_Width', 'S_Height', 'S_Thickness', 'Stock_quantity', 'S_Status'];

    public function wood()
    {
        return $this->belongsTo(Wood::class, 'WID');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'SID');
    }
}
