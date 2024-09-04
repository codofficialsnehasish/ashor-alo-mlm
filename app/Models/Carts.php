<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $table = "cart";
    protected $primaryKey = "id";

    protected $fillable = [
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public static function calculateTotalForUser($userId)
    {
        $cartItems = self::with('product')->where('buyer_id', $userId)->get();

        $total = $cartItems->reduce(function ($carry, $item) {
            return $carry + ($item->quantity * $item->product->price);
        }, 0);

        return $total;
    }

    public static function clearCartForUser($userId)
    {
        return self::where('buyer_id', $userId)->delete();
    }
}
