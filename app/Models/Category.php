<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model

{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description','slug', 'image','parent_id'];
    public function product() {
        return $this->hasMany(Product::class,'category_id');
    }
    public function CategoryParent() {
        return $this->hasMany(Category::class,'parent_id');
    }
    public function category() {
        return $this->belongsTo(Category::class,'parent_id');
    }
}
