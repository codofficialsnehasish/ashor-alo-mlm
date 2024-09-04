<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationStates extends Model
{
    use HasFactory;
    protected $table = "location_states";
    protected $primaryKey = "id";
}
