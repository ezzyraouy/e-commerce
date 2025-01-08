<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['unit_id','product_id', 'quantity','price'];
    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function unit() {
        return $this->belongsTo(Unit::class,'unit_id');
    }
}
