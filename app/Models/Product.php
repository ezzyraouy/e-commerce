<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description','slug', 'price', 'stock', 'image','category_id','unit_id','sizes'];

    public function images() {
        return $this->hasMany(Image::class,'product_id');
    }
    public function category() {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function unit() {
        return $this->belongsTo(Unit::class,'unit_id');
    }
    public function unitProducts() {
        return $this->hasMany(UnitProduct::class,'product_id');
    }
}
