<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyCornTest extends Model
{
    use HasFactory;

    protected $table = "dummy_corn_test";
    protected $primaryKey = "id";
}