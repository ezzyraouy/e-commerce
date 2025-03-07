<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model

{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'quantity'];
    public function product() {
        return $this->hasMany(Product::class,'unit_id');
    }
    public function unit() {
        return $this->hasMany(Unit::class,'unit_id');
    }
    
}
