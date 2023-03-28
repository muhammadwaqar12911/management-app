<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'item',
        'item_type',
        'item_note',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
