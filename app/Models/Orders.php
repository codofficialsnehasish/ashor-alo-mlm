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
}