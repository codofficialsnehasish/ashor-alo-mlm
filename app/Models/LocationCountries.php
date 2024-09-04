<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationCountries extends Model
{
    use HasFactory;
    protected $table = "location_countries";
    protected $primaryKey = "id";
}
