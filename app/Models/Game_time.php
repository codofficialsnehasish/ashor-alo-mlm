<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game_time extends Model
{
    use HasFactory;
    protected $table = "game_times";
    protected $primaryKey = "id";
}
