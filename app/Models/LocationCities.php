<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCities extends Model
{
    use HasFactory;
    protected $table = "location_cities";
    protected $primaryKey = "id";
}
