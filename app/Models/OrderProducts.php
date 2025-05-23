<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $table = "order_products";
    protected $primaryKey = "id";

    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}