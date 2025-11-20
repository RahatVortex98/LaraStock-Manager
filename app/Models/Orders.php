<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Item;
class Orders extends Model
{
    protected $fillable = ['user_id', 'total_price', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(Order_Item::class);
    }

    
}
