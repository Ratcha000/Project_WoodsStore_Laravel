<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wood extends Model
{
    //use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'WID';

    protected $table = 'woods';

    protected $fillable = ['WType', 'WPattern', 'W_Price'];

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'WID');
    }
}
