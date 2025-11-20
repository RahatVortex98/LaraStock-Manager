<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Add HasFactory
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory; // Use HasFactory trait
    
    
    protected $table = 'order__items'; 

    protected $fillable = [
        'orders_id',    
        'product_id', 
        'Qty', 
        'price'
    ];

    public function order() {
        
        return $this->belongsTo(Orders::class, 'orders_id');
    }

    public function product() {
        
        return $this->belongsTo(Product::class);
    }
}