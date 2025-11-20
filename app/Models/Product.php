<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','supplier_id','order_id','name',"Qty","unit_price","status"] ;    



    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function order(){
        return $this->belongsTo(Orders::class);
    }
    public function orderItems() {
    return $this->hasMany(Order_Item::class);
}

}
