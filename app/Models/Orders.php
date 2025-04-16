<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $primaryKey = "id";

    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    public function orderItem()
    {
        return $this->hasOne(OrderProducts::class,'order_id');
    }
}