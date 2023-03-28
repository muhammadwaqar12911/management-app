<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'runner',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
