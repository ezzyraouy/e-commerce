<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'status', 'total_amount'];

    public function OrderItems() {
        return $this->hasMany(OrderItems::class,'order_id');
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
