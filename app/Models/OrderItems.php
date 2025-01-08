<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItems extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id','unit_product_id', 'product_id', 'quantity','size','order_id'];

    public function orders() {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function UnitProduct() {
        return $this->belongsTo(UnitProduct::class,'unit_product_id');
    }
}
