<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_carts extends Model
{
    use HasFactory;
    protected $table = "game_cart";
    protected $primaryKey = "id";
}
