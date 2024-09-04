<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_settings extends Model
{
    use HasFactory;
    protected $table = "settings";
    protected $primaryKey = "id";
    public $timestamps = false;
}
